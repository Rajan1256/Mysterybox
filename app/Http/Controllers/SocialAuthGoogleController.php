<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use App\UserInfo;
use Auth;
use App\UserBalance;
use Exception;



class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        try {


            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('email',$googleUser->email)->first();


            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {

                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = md5(rand(1,10000));
                $user->RoleId = 2;
                $user->save();

                UserBalance::create([
                    'UserId'=>$user->id,
                    'Amount'=>0
                ]);
                UserInfo::create([
                    'UserId'=>$user->id,
                ]);

                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/');
        }
        catch (Exception $e) {
            return 'error';
        }
    }
}