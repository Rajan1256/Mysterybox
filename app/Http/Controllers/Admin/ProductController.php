<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers\Admin;
use App\JoinProduct;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{

   public function index()
   {
       if(Session::has('UserId')) {
           return view('Admin.Products');
       }
       else
       {
           return redirect('/Admin');
       }
   }

   public function mysterybox()
   {
       if(Session::has('UserId')) {
           return view('Admin.Mysterybox');
       }
       else
       {
           return redirect('/Admin');
       }
   }

   public function showbox()
   {
       if(Session::has('UserId')) {
           return view('Admin.Showbox');
       }
       else
       {
           return redirect('/Admin');
       }

   }

   public function assignproduct($MysteryboxId)
   {
       if(Session::has('UserId')) {
           return view('Admin.AssignProducts')->with('MysteryboxId', $MysteryboxId);
       }
       else
       {
           return redirect('/Admin');
       }
   }

   public function joinbox(Request $request)
   {
       if(Session::has('UserId')) {
           foreach ($request->selectedproduct as $item) {
               JoinProduct::create([
                   'MysteryboxId' => $request->mysteryboxid,
                   'MysteryboxProductId' => $item,
               ]);
           }
           return redirect()->back();
       }
       else
       {
           return redirect('/Admin');
       }
   }

   public function deletemysteryproduct(Request $request)
   {
       if(Session::has('UserId')) {
           DB::table('join_products')->where('MysteryboxId', $request->id)
               ->where('MysteryboxProductId', $request->pid)
               ->delete();
       }
       else
       {
           return redirect('/Admin');
       }
   }

   public function EditMysteryProduct($MysteryboxId)
   {
       if(Session::has('UserId')) {
           return view('Admin.EditMysterybox')->with('MysteryboxId', $MysteryboxId);
       }
       else
       {
           return redirect('/Admin');
       }
   }
   public function showproduct()
   {
       if(Session::has('UserId')) {
           return view('Admin.ShowProduct');
       }
       else
       {
           return redirect('/Admin');
       }
   }
   public function deleteproduct(Request $request)
   {
       if(Session::has('UserId')) {
           DB::table('mysterybox_products')
               ->where('MysteryboxProductId', $request->pid)
               ->delete();
            DB::table('join_products')
            ->where('MysteryboxProductId', $request->pid)
            ->delete();
       }
       else
       {
           return redirect('/Admin');
       }
   }
   public function editproduct($MysteryboxProductId)
   {
       if(Session::has('UserId')) {
           return view('Admin.EditProduct')->with('MysteryboxProductId', $MysteryboxProductId);
       }
       else
       {
           return redirect('/Admin');
       }
   }
}