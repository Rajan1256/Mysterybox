<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use App\AutoBot;
use App\Bid;
use App\MysteryBox;
use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Illuminate\Support\Facades\Auth;
use DB;

class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/');
    }

    public function newdesh()
    {
        if (Auth::check()) {
            echo "hi";
        }
        else
        {
            echo 'sry';
        }
    }

}