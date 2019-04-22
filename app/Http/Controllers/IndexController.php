<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use App\AutoBot;
use App\Bid;
use App\MysteryBox;
use App\TimerToken;
use App\User;
use Carbon\Carbon;
use App\UserBalance;
use App\WinuserMysterybox;
use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{

    public function getbid()
    {
        $st = Bid::with('user')->with('autobot')
            ->orderBy('BidId', 'DESC')
            ->where('MysteryboxId', Session::get('MysteryBox'))
            ->where('BidStatus', 0)
            ->where('IsDeleted', 0)
            ->limit(5)
            ->get();
        $newst = MysteryBox::where('BoxStatus', 0)->first();
        $mybid = Bid::orderBy('BidId', 'DESC')->where('BidStatus', 0)->first();
        $userbidbid = Bid::orderBy('BidId', 'DESC')
                        ->where('BidStatus', 0)
                        ->first();

        if ($mybid && $userbidbid)
        {
            $auto = AutoBot::where('IsDeleted', 0)->get()->toArray();

            date_default_timezone_set("America/New_York");

            if($newst->DummyUserMaxPrice>=$mybid->BidPrice && $userbidbid->AutoBotId==null && $userbidbid->UserId!=null)
                    Bid::create([
                    'AutoBotId' => $auto[array_rand($auto)]['AutoBotId'],
                    'MysteryboxId'=>Session::get('MysteryBox'),
                    'BidPrice' => $mybid->BidPrice+1
            ]);
        }
        echo json_encode(array('programs'=>$st,'baseprice'=>$newst));
    }

    public function addautobots()
    {
        $auto = AutoBot::where('IsDeleted',0)->get()->toArray();
       echo $auto[array_rand($auto)]['AutoBotId'];
        echo $auto[array_rand($auto)]['UserName'];


    }


    public function getproductview()
    {
        $mysteryview = MysteryBox::where('BoxStatus', 0)->first();
        Session::forget('MysteryBox');
        Session::put('MysteryBox', $mysteryview->MysteryboxId);
        if($mysteryview) {
            echo json_encode(array('pro' => $mysteryview));
        }
    }



    public function getproduct()
    {
        $mystery = MysteryBox::where('BoxStatus',0)->first();

        if($mystery)
        {
            $var =  MysteryBox::where('MysteryboxId',$mystery->MysteryboxId)->first();
            $var->BoxStatus = 1;
            $var->save();
        }
        $lastBox = MysteryBox::orderBy('MysteryboxId','desc')->first();

        if($lastBox->MysteryboxId == $mystery->MysteryboxId)
        {
            if($lastBox->BoxStatus==1)
            {
                DB::table('mysteryboxs')->update(['BoxStatus'=>0]);
            }
        }

        $lastbid = Bid::orderBy('BidId', 'DESC')->where('BidStatus',0)->first();

        if($lastbid)
        {
            WinuserMysterybox::create([
                'BidId'=>$lastbid->BidId
            ]);
            UserBalance::where('UserId',$lastbid->UserId)
                ->decrement('Amount',$lastbid->BidPrice);

            DB::table('bids')->update([
                'BidStatus'=>1
            ]);
        }
        $rand_str = str_random(16);

        $make_token = TimerToken::create([
            'TimeToken'=>$rand_str
        ]);

        echo json_encode(array('token' => $make_token->TimeToken));

    }

    public function checkemail(Request $request){
        // ->whereIn('id', [1,2,3])
        $user = DB::table('users')->where('email',$request->email)->first();
        if($user){
            echo "1";
        }else{
            echo "0";
        }
    }


    public function checkbidprice(Request $request)
    {
        $box = MysteryBox::where('MysteryBoxId',Session::get('MysteryBox'))->first();
        $userbal = UserBalance::where('UserId',Auth::user()->id)->first();
        $bidbox = Bid::orderBy('BidId', 'DESC')
            ->where('MysteryBoxId',Session::get('MysteryBox'))
            ->where('BidStatus',0)
            ->where('IsDeleted',0)->first();
        $lastamt =  $request->useramount;


            if($box && $userbal)
            {
                if($userbal->Amount < $lastamt)
                {
                    echo "1";
                }
                else
                {
                    echo "0";
                }
            }

    }

    public function checkbidless(Request $request)
    {
        $box = MysteryBox::where('MysteryBoxId',Session::get('MysteryBox'))->first();
        $userbal = UserBalance::where('UserId',Auth::user()->id)->first();
        $bidbox = Bid::orderBy('BidId', 'DESC')
            ->where('MysteryBoxId',Session::get('MysteryBox'))
            ->where('BidStatus',0)
            ->where('IsDeleted',0)->first();
        $lastamt =  $request->useramount;


        if($box && $userbal)
        {
            if($box->MysteryboxBasePrice > $lastamt)
            {
                echo "1";
            }
            else
            {
                if($bidbox)
                {
                    if($lastamt < $bidbox->BidPrice)
                    {
                        echo "1";
                    }
                    else
                    {
                        echo "0";
                    }
                }
                else
                {
                    echo "0";
                }

            }
        }
    }



    public function addbidbutton(Request $request)
    {


        $this->validate($request,[
            'bidprice'=>'required|min:0|not_in:0.0',
        ]);
        $box = MysteryBox::where('MysteryBoxId',Session::get('MysteryBox'))->first();
        $userbal = UserBalance::where('UserId',Auth::user()->id)->first();

        $bidbox = Bid::orderBy('BidId', 'DESC')
            ->where('MysteryBoxId',Session::get('MysteryBox'))
            ->where('BidStatus',0)
            ->where('IsDeleted',0)->first();
        $lastamt =  $request->bidprice;


        if($box && $userbal)
        {
            if($box->MysteryboxBasePrice > $lastamt)
            {
                echo "1";
            }
            else if($userbal->Amount < $lastamt)
            {
                echo "1";
            }
            else
            {
                if($bidbox)
                {

                    if($bidbox->BidPrice > $lastamt)
                    {
                        echo "1";
                    }
                    else
                    {
                        date_default_timezone_set("America/New_York");
                        Bid::create([
                            'MysteryboxId'=>Session::get('MysteryBox'),
                            'UserId'=>Auth::user()->id,
                            'BidPrice'=>$lastamt,
                            'Created_At'=>Carbon::now()->toDateTimeString()
                        ]);
                    }
                }
                else
                {
                    date_default_timezone_set("America/New_York");
                    Bid::create([
                        'MysteryboxId'=>Session::get('MysteryBox'),
                        'UserId'=>Auth::user()->id,
                        'BidPrice'=>$lastamt,
                        'Created_At'=>Carbon::now()->toDateTimeString()
                    ]);
                }

                return response(['success' => true], 200);
            }

        }


    }


    public function addbid(Request $request)
    {
        $this->validate($request,[
            'bidprice'=>'required|min:0|not_in:0.0',
        ]);
        $box = MysteryBox::where('MysteryBoxId',Session::get('MysteryBox'))->first();
        $userbal = UserBalance::where('UserId',Auth::user()->id)->first();

        $bidbox = Bid::orderBy('BidId', 'DESC')
            ->where('MysteryBoxId',Session::get('MysteryBox'))
            ->where('BidStatus',0)
            ->where('IsDeleted',0)->first();
        $lastamt = $box->MysteryboxBasePrice + $request->bidprice;


        if($box && $userbal)
        {

            if($userbal->Amount < $lastamt)
            {
                echo "1";
            }
            else
            {
                if($bidbox)
                {
                    if($userbal->Amount < $bidbox->BidPrice+$request->bidprice)
                    {
                        echo "1";
                    }
                    else
                    {
                        date_default_timezone_set("America/New_York");
                        Bid::create([
                            'MysteryboxId'=>Session::get('MysteryBox'),
                            'UserId'=>Auth::user()->id,
                            'BidPrice'=>$bidbox->BidPrice +$request->bidprice,
                            'Created_At'=>Carbon::now()->toDateTimeString()
                        ]);
                    }
                }
                else
                {
                    date_default_timezone_set("America/New_York");
                    Bid::create([
                        'MysteryboxId'=>Session::get('MysteryBox'),
                        'UserId'=>Auth::user()->id,
                        'BidPrice'=>$lastamt,
                        'Created_At'=>Carbon::now()->toDateTimeString()
                    ]);
                }

                return response(['success' => true], 200);
            }

        }

    }



    public function checkbidbuttonprice(Request $request)
    {
        $box = MysteryBox::where('MysteryBoxId',Session::get('MysteryBox'))->first();
        $userbal = UserBalance::where('UserId',Auth::user()->id)->first();
        $bidbox = Bid::orderBy('BidId', 'DESC')
            ->where('MysteryBoxId',Session::get('MysteryBox'))
            ->where('BidStatus',0)
            ->where('IsDeleted',0)->first();
        $lastamt = $box->MysteryboxBasePrice + $request->buttonamount;


        if($box && $userbal)
        {
            if($userbal->Amount < $lastamt)
            {
                echo "1";
            }
            else
            {
                if($bidbox)
                {
                    if($userbal->Amount < $bidbox->BidPrice+$request->buttonamount)
                    {
                        echo "1";
                    }
                    else
                    {
                        echo "0";
                    }
                }
                else
                {
                    echo "0";
                }

            }
        }
    }

    public function showproduct($token)
    {
        $tkn = TimerToken::where('TimeToken',$token)->first();
        if($tkn)

            return view('Client.AuctionWinner');
        else
            return redirect('/');
    }


    public function deletetoken()
    {
        DB::table('winuser_mysteryboxs')->update([
           'MysteryboxStatus'=>1
        ]);

        TimerToken::truncate();
        echo json_encode(array('newdata' => 'hi'));
    }


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
            User::where('id',Auth::user()->id)->update([
               'name'=>$request->username,
                'Dob'=>$request->dob
            ]);
            return redirect()->back();
        }
        return view('/');
    }

}