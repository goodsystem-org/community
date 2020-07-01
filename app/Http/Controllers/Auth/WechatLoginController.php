<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Contracts\User;

class WechatLoginController extends SocialLoginController
{
    protected $vendor = 'wechat_web';

    // fallback is for WeChat users
    // $providerUser->getName() || $providerUser->getNickname();
    // $providerUser->getEmail() || $providerUser->getId();

    protected function getUserEmail(User $providerUser)
    {
        return 'wechat-' . $providerUser->getId() . '@goodsystem.org';
    }

    protected function getUserName(User $providerUser)
    {
        return $providerUser->getNickname();
    }

    protected function getUser(User $providerUser, $email, $name)
    {
        return \App\User::whereEmail($this->getUserEmail($providerUser))->first();
    }
}


