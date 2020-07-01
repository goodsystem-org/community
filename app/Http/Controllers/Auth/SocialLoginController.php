<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\SocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use \Laravel\Socialite\Contracts\User;
use Illuminate\Support\Facades\File;

abstract class SocialLoginController extends Controller
{
    protected $vendor = '';
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver($this->vendor)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver($this->vendor)->user();

        // TODO save to pre launch table
/*
        if ($createdUser = $this->createOrGetUser($user)) {
            Auth::loginUsingId($createdUser->id, true);
        }*/

        $intended = session('redirectAfterAuth') ?: '/';

        $request->session()->forget('redirectAfterAuth');

        return redirect($intended);
    }

    protected function createOrGetUser(User $providerUser)
    {
        $name = $this->getUserName($providerUser);
        $email = $this->getUserEmail($providerUser);

        // Still allow if email not allowed.
        // TODO this needs to change
        if (!trim($email)) {
            \Log::info("\n\n" . $this->vendor . " user $name logged in but without sharing email address with us.\n\n");
            return \App\User::find(104);
        }

        $user = $this->getUser($providerUser, $email, $name);
        if (!$user) {
            $user = new \App\User;
            $user->name = $name;
            $user->email = $email;
            // make it up for social log in
            $user->password = \Hash::make(md5(rand(1, 10000)));
            $user->save();

            $data = ['name' => $name, 'email' => $email, 'toName' => 'Good System'];
            $to = ['name' => 'Good System Contact', 'email' => 'contact@goodsystem.org'];
            \Mail::send('notifications.new-user', $data, function ($message) use ($to) {
                $message->from(env('MAIL_USERNAME', 'notifications@goodsystem.org'), 'Good System Notifications')
                    ->to($to['email'], $to['name'])
                    ->subject('A new user just signed in');
            });
        }

        $this->setVendorTag($user);

        // $this->setSocialAccount($user, $providerUser);

        return $user;

        // TODO create a new entity/model to store social login account and associate with user
    }

    protected function getUserName(User $providerUser)
    {
        return $providerUser->getName();
    }

    protected function getUserEmail(User $providerUser)
    {
        return $providerUser->getEmail();
    }

    protected function getUser(User $providerUser, $email, $name)
    {
        return \App\User::whereEmail($email)->first();
    }

    protected function setVendorTag(\App\User $user)
    {
        // social vendor tag
        if (!in_array($this->vendor, $user->tags->pluck('name')->all())) {
            $user->attachTag($this->vendor);
        }
    }

    protected function setSocialAccount(\App\User $user, User $providerUser)
    {
        // social account
        $socialAccount = SocialAccount::whereVendor($this->vendor)
            ->whereSocialId($providerUser->getId())
            ->whereUserId($user->id)
            ->first();

        // create if it doesn't already exist
        if (!$socialAccount) {
            $socialAccount = new SocialAccount([
                'vendor' => $this->vendor,
                'name' => $this->getUserName($providerUser),
                'nick_name' => $providerUser->getNickname(),
                'email' => $providerUser->getEmail(),
                'social_id' => $providerUser->getId(),
                'user_id' => $user->id
            ]);
            if ($this->saveAvatar($providerUser->getAvatar(), $user->id)) {
                $socialAccount->avatar = $this->composeSocialAvatarPath($user->id);
            }
            $socialAccount->save();
        } else {
            // do nothing if it already exists ?  Like, update avatar ??
        }
    }

    protected function saveAvatar($file, $userId) {
        $fileContents = file_get_contents($file);
        return File::put(storage_path('app/social_avatars/') . $this->composeSocialAvatarPath($userId), $fileContents);
    }

    protected function composeSocialAvatarPath($userId)
    {
        return $this->vendor . '-' . $userId . '.jpeg';
    }
}


