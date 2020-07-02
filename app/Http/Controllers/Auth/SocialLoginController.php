<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\SocialAccount;
use App\Person;
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

        if ($createdUser = $this->createOrGetUser($user)) {
            Auth::loginUsingId($createdUser->id, true);
        }

        $intended = session('redirectAfterAuth') ?: '/';

        $request->session()->forget('redirectAfterAuth');

        return redirect($intended);
    }

    /**
     * When a user signs in with a social account, the following should happen
     * 1. retrieve email address or populate a fake one from provider information
     * 2. use the email to look up in App\User
     * 2.1 if found, return it
     * 2.2 if not found, create it
     * 3. Retrieve first person associated with the user
     * 3.1 if found, update ID and other info for the person
     * 3.2 if not found, create one and associate with the user
     *
     * @param User $providerUser
     * @return \App\User|void
     */
    protected function createOrGetUser(User $providerUser)
    {
        $name = $this->getUserName($providerUser);
        $email = $this->getUserEmail($providerUser);

        // Still allow if email not allowed.
        // TODO this may need to be changed.  At this time, only using WeChat, so a fake email is created with WeChat ID for this purpose.
        if (!trim($email)) {
            \Log::info("\n\n" . $this->vendor . " user $name logged in but without sharing email address with us.\n\n");
            return abort(403, 'Not authorized.');
        }

        $user = $this->getUser($providerUser, $email, $name);
        if (!$user) {
            $user = new \App\User;
            $user->name = $name;
            $user->email = $email;
            // make it up for social log in
            $user->password = \Hash::make(md5(rand(1, 10000)));
            $user->save();
/*
            $data = ['name' => $name, 'email' => $email, 'toName' => 'Good System'];
            $to = ['name' => 'Good System Contact', 'email' => 'contact@goodsystem.org'];
            \Mail::send('notifications.new-user', $data, function ($message) use ($to) {
                $message->from(env('MAIL_USERNAME', 'notifications@goodsystem.org'), 'Good System Notifications')
                    ->to($to['email'], $to['name'])
                    ->subject('A new user just signed in');
            });*/
        }

        $this->createOrUpdatePerson($user, $providerUser);

/*        $this->setVendorTag($user);*/

        // $this->setSocialAccount($user, $providerUser);

        return $user;
    }

    protected function createOrUpdatePerson(\App\User $appUser, User $providerUser)
    {
        // Note that person record is also created upon traditional registration process by email.
        // So when a person sign in with a social account instead of traditional login with email and password,
        // lookup by email may find that traditional user account.  In that case, person profile should be updated
        // with the social account information.
        // In the case that a traditional user account is just created, there won't be person associated,
        // and one would be created.
        if ($person = $appUser->people->first()) {
            $profile = $person->profile;
        } else {
            $person = new Person();
            // In the case of social accounts, first name and last name may not be accurate, but we need something here.
            $person->first_name = $this->getProviderUserFirstName($providerUser);
            $person->last_name = $this->getProviderUserLastName($providerUser);
            $person->avatar = $providerUser->getAvatar();
            $profile['email'] = $this->getUserName($providerUser);
        }
        $profile = $this->fillVendorInfoInPersonProfile($profile, $providerUser);
        $person->profile = $profile;
        $person->save();

        $appUser->people()->sync([$person->id]);

        return $person;
    }

    protected function fillVendorInfoInPersonProfile($profile, User $providerUser)
    {
        $profile[$this->vendor] = [
            'id' => $providerUser->getId(),
            'avatar' => $providerUser->getAvatar(),
            'name' => $providerUser->getName(),
            'nickName' => $providerUser->getNickname(),
        ];
        return $profile;
    }

    protected function getProviderUserFirstName(User $providerUser)
    {
        return $this->getUserName($providerUser);
    }

    protected function getProviderUserLastName(User $providerUser)
    {
        return $this->getUserName($providerUser);
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


