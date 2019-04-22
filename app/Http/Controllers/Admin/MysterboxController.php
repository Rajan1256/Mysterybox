<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\MysteryBox;
use App\Product;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class MysterboxController extends Controller
{

    public function addmysterybox(Request $request)
    {
        if(Session::has('UserId'))
        {
            $input = array(
                'boxname'=>$request->boxname,
                'boxbaseprice' => $request->boxbaseprice,
                'percentage' => $request->percentage,
                'maxprice' => $request->maxprice,
                'description' => $request->description,
            );

            $rules = array(
                'boxname'=>'required|min:6|max:50',
                'boxbaseprice' => 'required|numeric',
                'percentage'=>'required|numeric|between:0,100',
                'maxprice' => 'required|numeric',
                'description' => 'required',
            );
            $messages = array(
                'boxname.required' => 'Please enter mysterybox name',
                'boxname.min'=>'The mystery box name must be at least 6 characters.',
                'boxname.max'=>'The mystery box name may not be greater than 50 characters.',
                'boxbaseprice.required' => 'Please enter mysterybox price',
                'boxbaseprice.numeric'=>'Only amount in this field',
                'percentage.required' => 'Please enter mysterybox autobot percentage',
                'percentage.numeric' => 'Only number allow',
                'percentage.between' => 'Up to 100 % allow only',
                'maxprice.required' => 'Please enter mysterybox autobot last limit',
                'maxprice.numeric'=>'Only amount allow in this field',
                'description.required' => 'Please enter description',
            );

            $validation = Validator::make($input, $rules, $messages);

            if ($validation->fails()) {
                return \Redirect::back()->withErrors($validation->errors()) ->withInput();

            }
            else
            {
                MysteryBox::create([
                    'UserId'=>5,
                    'MysteryboxName'=>$request->boxname,
                    'MysteryboxBasePrice'=>$request->boxbaseprice,
                    'ProbabilityPercentage'=>$request->percentage,
                    'DummyUserMaxPrice'=>$request->maxprice,
                    'Description' => $request->description
                ]);

                return redirect()->back()->with('successmessage','Mysterybox added successfully!');
            }
        }
        else
        {
            return redirect('/Admin');
        }

    }



    public function addproducts(Request $request)
    {
        if(Session::has('UserId')) {
            $input = array(
                'productname' => $request->productname,
                'productimage' => $request->productimage,
                'productprice' => $request->productprice,
            );

            $rules = array(
                'productname' => 'required|min:3|max:50',
                'productimage' => 'required|max:2048',
                'productprice' => 'required|numeric'
            );
            $messages = array(
                'productname.required' => 'Please enter product name',
                'productname.min' => 'The product name must be at least 3 characters.',
                'productname.max' => 'The product name may not be greater than 50 characters.',
                'productimage.required' => 'Please select product image',
                'productimage.max' => 'Up to 2mb image size allow',
                'productprice.required' => 'Please enter product price',
                'productprice.numeric' => 'Only amount allow in this field',
            );

            $validation = Validator::make($input, $rules, $messages);

            if ($validation->fails()) {
                return \Redirect::back()->withErrors($validation->errors())->withInput();

            } else {

                $image = $request->file('productimage');
                $path = public_path() . '/ProductImg/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                Product::create([
                    'UserId' => 5,
                    'ProductName' => $request->productname,
                    'ProductPrice' => $request->productprice,
                    'ProductImage' => $filename
                ]);

                return redirect()->back()->with('successmessage', 'Product added successfully!');
            }
        }
        else
        {
            return redirect('/Admin');
        }
    }


    public function deletemsterybox(Request $request)
    {
        if(Session::has('UserId')) {
            DB::table('mysteryboxs')->where('MysteryboxId', $request->id)
                ->delete();

            DB::table('join_products')->where('MysteryboxId', $request->id)
                ->delete();
        }
        else
        {
            return redirect('/Admin');
        }
    }


    public function updatemystery(Request $request)
    {
        if(Session::has('UserId')) {
            $input = array(
                'boxname' => $request->boxname,
                'boxbaseprice' => $request->boxbaseprice,
                'percentage' => $request->percentage,
                'maxprice' => $request->maxprice,
                'description'=>$request->description,
            );

            $rules = array(
                'boxname' => 'required|min:6|max:50',
                'boxbaseprice' => 'required|numeric',
                'percentage' => 'required|numeric|between:0,100',
                'maxprice' => 'required|numeric',
                'description'=>'required'
            );
            $messages = array(
                'boxname.required' => 'Please enter mysterybox name',
                'boxname.min' => 'The mystery box name must be at least 6 characters.',
                'boxname.max' => 'The mystery box name may not be greater than 50 characters.',
                'boxbaseprice.required' => 'Please enter mysterybox price',
                'boxbaseprice.numeric' => 'Only amount in this field',
                'percentage.required' => 'Please enter mysterybox autobot percentage',
                'percentage.numeric' => 'Only number allow',
                'percentage.between' => 'Up to 100 % allow only',
                'maxprice.required' => 'Please enter mysterybox autobot last limit',
                'maxprice.numeric' => 'Only amount allow in this field',
                'description.required'=>'Please enter mysterybox description'
            );

            $validation = Validator::make($input, $rules, $messages);

            if ($validation->fails()) {
                return \Redirect::back()->withErrors($validation->errors())->withInput();

            } else {
                MysteryBox::where('MysteryboxId', $request->mysteryid)->update([
                    'UserId' => 5,
                    'MysteryboxName' => $request->boxname,
                    'MysteryboxBasePrice' => $request->boxbaseprice,
                    'ProbabilityPercentage' => $request->percentage,
                    'DummyUserMaxPrice' => $request->maxprice,
                    'Description' => $request->description
                ]);

                return redirect('Admin/showbox')->with('successmessage', 'Mysterybox updated successfully!');
            }
        }
        else
        {
            return redirect('/Admin');
        }
    }

    public function updateproduct(Request $request)
    {
        if(Session::has('UserId')) {
            $input = array(
                'productname' => $request->productname,
                'productimage' => $request->productimage,
                'productprice' => $request->productprice,
            );

            $rules = array(
                'productname' => 'required|min:3|max:50',
                'productprice' => 'required|numeric'
            );
            $messages = array(
                'productname.required' => 'Please enter product name',
                'productname.min' => 'The product name must be at least 3 characters.',
                'productname.max' => 'The product name may not be greater than 50 characters.',
                'productprice.required' => 'Please enter product price',
                'productprice.numeric' => 'Only amount allow in this field',
            );

            $validation = Validator::make($input, $rules, $messages);

            if ($validation->fails()) {
                return \Redirect::back()->withErrors($validation->errors())->withInput();

            } else {
                $image = $request->file('productimage');

                if($image=='')
                {
                    
                    Product::where('MysteryboxProductId', $request->productid)->update([
                        'UserId' => 5,
                        'ProductName' => $request->productname,
                        'ProductPrice' => $request->productprice
                    ]);
                }
                else
                {
                    $path = public_path() . '/ProductImg/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);

                Product::where('MysteryboxProductId', $request->productid)->update([
                    'UserId' => 5,
                    'ProductName' => $request->productname,
                    'ProductPrice' => $request->productprice,
                    'ProductImage' => $filename
                ]);
                }
            

                return redirect('Admin/showproduct')->with('successmessage', 'Product updated successfully!');
            }
        }
        else
        {
            return redirect('/Admin');
        }
    }

}