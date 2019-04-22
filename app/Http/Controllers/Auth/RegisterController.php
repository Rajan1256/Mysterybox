<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\UserBalance;
use http\Env\Request;
use App\UserInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'UserName' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:users',
            'passwordreg' => 'required',
            'mydate'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // $request = request();

        // $profileImage = $request->file('ProfileImage');
        // $profileImageSaveAsName = time() . "-profile." .
        //     $profileImage->getClientOriginalExtension();

        // $upload_path = 'profile_images/';
        // $profile_image_url = $upload_path . $profileImageSaveAsName;
        // $success = $profileImage->move($upload_path, $profileImageSaveAsName);


            $user =  User::create([
                'name' => $data['UserName'],
                'email' => $data['Email'],
                'password' => bcrypt($data['passwordreg']),
                'Dob'=>$data['mydate'],
                'RoleId'=>$data['RoleId'],
            ]);

            UserBalance::create([
                'UserId'=>$user->id,
                'Amount'=>0
            ]);

            UserInfo::create([
            'UserId'=>$user->id,
        ]);
            return $user;

    }
}
