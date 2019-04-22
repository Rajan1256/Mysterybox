<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use App\AutoBot;
use App\Bid;
use App\MysteryBox;
use App\TimerToken;
use App\User;
use Hash;
use App\UserBalance;
use App\WinuserMysterybox;
use Illuminate\Http\Request;
use Socialite;
use App\UserInfo;
use App\Services\SocialFacebookAccountService;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function EditProfile()
    {
        if (Auth::user())
        {
            return view('Client.EditProfile');
        }
        return view('/');
    }

    public function UpdtaeProfile(Request $request)
    {

        if (Auth::user())
        {
            if($_POST['cropadd']=='')
            {
                User::where('id',Auth::user()->id)->update([
                    'name'=>$request->username,
                    'Dob'=>$request->dob
                ]);
                return back()->with('successmessage','Profile updated successfully!');
            }
            else
            {

                $data = $_POST['cropadd'];

                $size12 = (int) (strlen(rtrim($data, '=')) * 3 / 4);
                $size_in_kb    = $size12 / 1024;
                $size_in_mb    = $size_in_kb / 1024;


                $size = getimagesize($data);

                        if($size_in_mb >2)
                        {
                            return back()->with('errormessage','Up to 2mb file size allow');
                        }
                        else if($size['mime']=='image/jpeg' || $size['mime']=='image/png' || $size['mime']=='image/jpeg')
                        {
                            $data = $_POST['cropadd'];
                            list($type, $data) = explode(';', $data);
                            list(, $data)      = explode(',', $data);
                            $data = base64_decode($data);
                            $imageName = uniqid() . '.png';
                            $file = 'profile_images/' . $imageName;
                            file_put_contents($file, $data);
                            $imgUpld = $imageName;
                            User::where('id',Auth::user()->id)->update([
                                'name'=>$request->username,
                                'Dob'=>$request->dob,
                                'ProfileImage'=>$imgUpld
                            ]);
                            return back()->with('successmessage','Profile updated successfully!');
                        }
                        else
                        {
                            return back()->with('errormessage','only jpg,png,jpeg allow');
                        }

            }

        }
        return view('/');
    }


    public function changepassword()
    {
        if (Auth::user())
        {
            return view('Client.ChangePassword');
        }
        return view('/');
    }


    public function updatePassword(Request $request)
    {
        if (Auth::user()) {
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);
            $data = $request->all();

            $user = User::find(auth()->user()->id);
            if (!Hash::check($data['old_password'], $user->password)) {
                return back()
                    ->with('errormessage', 'The specified password does not match the database password');
            } else {

                $user = Auth::user();
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                return back()
                    ->with('successmessage', 'Your password is updated');
            }
        }
        return view('/');
    }

    public function fund()
    {
        if (Auth::user())
        {
            return view('Client.AddFund');
        }
        return view('/');
    }

    public function addamount(Request $request)
    {
        if (Auth::user()) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:0|not_in:0'
            ]);

            UserBalance::where('UserId',Auth::user()->id)->increment('Amount',$request->amount);
            return redirect()->back()->with('success','Amount  added successfully!');
        }
        return view('/');
    }

    public function billinginfo()
    {
        if (Auth::user()) {
            $countries = DB::table("countrys")->pluck("CountryName","CountryId");
            return view('Client.BillingInfo',compact('countries'));
        }
        return view('/');
    }

    public function editbillinginfo(Request $request)
    {
        UserInfo::where('UserId',Auth::user()->id)->update([
            'FirstName'=>$request->FirstName,
            'LastName'=>$request->LastName,
            'PostelCode'=>$request->PostelCode,
            'Address'=>$request->Address,
            'CountryId'=>$request->country,
            'StateId'=>$request->state,
            'CityId'=>$request->city,
            'ContactName'=>$request->ContactName,
            'MobileNo'=>$request->MobileNo
        ]);

        return redirect()->back();
    }
}