<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UserInfo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\UserBalance;
use Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {


        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'RoleId'=>$request->RoleId]))
        {
            return response(['success' => true], 200);
        }
        else
        {
            return
            response([
                'success' => false,
                'message' => 'Invalid email or password!'
            ], 422);
        }
    }



    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect()->route('home');
    }

    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser){
            return $authUser;
        }
        if($facebookUser->email==null)
        {
            $email = ' ';
        }
        else
        {
            $email = $facebookUser->email;
        }
        $usr =  User::create([
            'name' => $facebookUser->name,
            'email' => $email,
            'password'=>md5(rand(1,10000)),
            'facebook_id' => $facebookUser->id,
            'RoleId'=>2
        ]);
            UserBalance::create([
                'UserId'=>$usr->id,
                'Amount'=>0
            ]);
            UserInfo::create([
               'UserId'=>$usr->id,
            ]);
        return $usr;


    }

}
