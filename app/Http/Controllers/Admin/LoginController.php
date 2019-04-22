<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\ResetPassword;
use Mail;
class LoginController extends Controller
{

    public function login(Request $request)
    {
        $email =  $request->input('EmailId');
        $password = $request->input('Password');
        $input = array(
            'EmailId' => $email,
            'Password' => $password,
        );
        $rules = array(

            'EmailId' => 'required|email|exists:users,email',
            'Password' => 'required',
        );

        $messages = array(
            'EmailId.required' => 'Email id is required',
            'EmailId.exists'=>'This email is not exist',
            'Password.required' => 'Password is required',
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::back()->withErrors($validation->errors()) ->withInput();
        }
        $newUser = new User();
        $userData = $newUser->getAdminByColumnName('email', $email);


        if ($userData) {
            if (\Hash::check($password, $userData->password) == true) {

                $userId = $userData->id;
                $userEmail = $userData->email;

                Session::put('UserId', $userId);
                Session::put('email', $userEmail);
                $return = ['status' => 'success', 'message' => 'Logged in successfully!!'];

                //Session::flash('message', '<div class="alert alert-' . ($return['status'] == 'error' ? 'danger' : $return['status']) . '"><strong>' . ucfirst($return['status']) . '!</strong> ' . $return['message'] . '</div>');

                return redirect('/Admin/showbox');
            }
                else {
                    $return =  'Invalid password!';
                }

        } else {
            $return =  'Invalid email and password!';
        }
        Session::flash('message',$return);
        return redirect()->back()->withInput();

    }

    public function index()
    {
        if(Session::has('UserId')) {
            return view('Admin.index');
        }
        else
        {
            return redirect('/Admin');
        }
    }
    public function logout(Request $request) {
        Session::forget('UserId');
        return redirect(url('/Admin'));
    }

    public function forgotpassword(Request $request)
    {
        return view('Admin.ForgetPassword');
    }

    public function resetpasswordlink(Request $request)
    {
        $input = array(

            'email' => $request->input('email'),

        );
        $rules = array(

            'email' => 'required|email|exists:users,email',
        );
        $messages = array(

            'email.required' => 'Please enter email address',
            'email.email' => 'Please enter valid email address',
            'email.exists'=>'This email is not exist'
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::back()->withErrors($validation->errors()) ->withInput();

        }

        $chk_email = User::where('email',$request->email)->where('RoleId',1)->first();
        $rand_str = str_random(16);
        if($chk_email)
        {
            $pass = ResetPassword::where('UserId',$chk_email->id)->count();
            if($pass>=1)
            {
                ResetPassword::where('UserId',$chk_email->id)->update([
                    'PasswordResetToken'=>$rand_str,
                    'EmailId'=>$chk_email->email,
                    'UpdatedAt'=>date('Y-m-d H:i:s'),
                ]);

                // $link_url = 'http://differenzuat.com/MuzeNew/index.php/business/resetpassword/'.$rand_str;
                $link_url = 'http://localhost/NewProject/Admin/resetpassword/'.$rand_str;
                $data = array('name'=>$chk_email->name,'link'=>$link_url);
                $userEmail = $chk_email->email;
                $userName = $chk_email->name;
                Mail::send('email.ResetPassword', $data, function($message) use ($userEmail, $userName) {
                    $message->to($userEmail, $userName)->subject('Reset Password');
                    $message->from(getenv('FROM_EMAIL_ADDRESS'), "cajas mystrybox");
                });

            }
            else
            {
                ResetPassword::create([
                    'UserId'=> $chk_email->id,
                    'PasswordResetToken'=>$rand_str,
                    'EmailId'=>$chk_email->email,
                ]);

                // $link_url = 'http://differenzuat.com/MuzeNew/index.php/business/resetpassword/'.$rand_str;
                $link_url = 'http://localhost/NewProject/Admin/resetpassword/'.$rand_str;
                $data = array('name'=>$chk_email->name,'link'=>$link_url);
                $userEmail = $chk_email->email;
                $userName = $chk_email->name;
                Mail::send('email.ResetPassword', $data, function($message) use ($userEmail, $userName) {
                    $message->to($userEmail, $userName)->subject('Reset Password');
                    $message->from('xyz@gmail.com', 'Cajas mysterybox');
                });

            }
            return redirect()->back()->with('codemessage1','Reset password link send on you email id!');
        }
        else
        {
            return redirect()->back()->with('codemessage','Email id not exist!');
        }
    }


    public function resetpassword($token)
    {
        $tkn = ResetPassword::where('PasswordResetToken',$token)->first();
        if($tkn)
            return view('Admin.ChangePassword')->with('newtoken',$tkn->PasswordResetToken);
        else
            return redirect('/Admin');
    }

    public function ChangePassword(Request $request)
    {
        $Password =  $request->input('Password');
        $ConformPassword = $request->input('ConformPassword');


        $input = array(
            'Password' => $Password,
            'ConformPassword' => $ConformPassword,
        );
        $rules = array(
            'Password' => 'required|min:6',
            'ConformPassword' => 'required|min:6|same:Password'
        );
        $messages = array(

            'Password.required' => 'Please enter password',
            'ConformPassword.required' => 'Please enter conform password',
            'Password.min' => 'Password must be at least 6 characters long',
            'ConformPassword.min' => 'Conform password must be at least 6 characters long',
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::back()->withErrors($validation->errors()) ->withInput();

        }
        else
        {
            $rst_pass = ResetPassword::where('PasswordResetToken',$request->token)->first();

            if($rst_pass)
            {
                User::where('id',$rst_pass->UserId)->update([
                    'Password'=>bcrypt($request->Password)
                ]);
                ResetPassword::where('UserId',$rst_pass->UserId)->delete();

                return redirect('/Admin')->with('passmsg','Password updated successfully!');
            }
        }
    }

}
