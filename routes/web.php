<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Client.index');
});

Route::get('get-state-list','DropdownController@getStateList');
Route::get('get-city-list','DropdownController@getCityList');

Route::any('/checkelogmobile', 'DropdownController@checkelogmobile');


Route::get('/Admin', function () {
    return view('Admin.Login');
});
Route::get('logoutAdmin', 'Admin\LoginController@logout')->name('logoutAdmin');

Route::post('/Adminlogin','Admin\LoginController@login')->name('adminlogin');
Route::get('/forgotpassword','Admin\LoginController@forgotpassword');
Route::post('/resetpasswordlink','Admin\LoginController@resetpasswordlink')->name('resetpasswordlink');
Route::get('Admin/resetpassword/{token}', 'Admin\LoginController@resetpassword');
Route::post('Admin/ChangePassword', 'Admin\LoginController@ChangePassword');

Route::group(['middleware' => 'prevent-back-history'],function(){

Route::get('/Admindeshbord', 'Admin\LoginController@index');
Route::get('Admin/products', 'Admin\ProductController@index');
Route::get('Admin/mysterybox', 'Admin\ProductController@mysterybox');
Route::get('Admin/showbox', 'Admin\ProductController@showbox');
Route::post('/addmysterybox','Admin\MysterboxController@addmysterybox')->name('addmysterybox');
Route::post('/addproducts','Admin\MysterboxController@addproducts')->name('addproducts');
Route::post('/removemsterybox', 'Admin\MysterboxController@deletemsterybox')->name('removemsterybox');
Route::post('/updatemystery', 'Admin\MysterboxController@updatemystery')->name('updatemystery');


Route::get('assignproduct/{MysteryboxId}', 'Admin\ProductController@assignproduct');
Route::post('/joinbox','Admin\ProductController@joinbox')->name('joinbox');
Route::post('/removemsteryproduct', 'Admin\ProductController@deletemysteryproduct')->name('removemsteryproduct');
Route::get('EditMysteryProduct/{MysteryboxId}', 'Admin\ProductController@EditMysteryProduct');

Route::get('Admin/showproduct', 'Admin\ProductController@showproduct');
Route::get('editproduct/{MysteryboxProductId}', 'Admin\ProductController@editproduct');
Route::post('/removeproduct', 'Admin\ProductController@deleteproduct')->name('removeproduct');
});

Route::post('/updateproduct', 'Admin\MysterboxController@updateproduct')->name('updateproduct');

Route::any('/checkemail', 'IndexController@checkemail');

Route::post('/login', 'Auth/LoginController@login')->name('login');

Route::get('/',function(){
    return view('Client.index');
})->name('home');

Route::get('/dm', function () {
    return view('Dummy');
});

Auth::routes();
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');


// Route::get('/redirectfacebook', 'SocialAuthFacebookController@redirect');
// Route::get('/callbackfacebook', 'SocialAuthFacebookController@callback');

Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/callbackfacebook', 'Auth\LoginController@handleProviderCallback');

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/dt','SocialAuthFacebookController@newdesh');


Route::get('/addautobots','indexController@addautobots');
Route::get('getbid','IndexController@getbid')->name('getbid');
Route::get('getproduct','IndexController@getproduct')->name('getproduct');
Route::get('getproductview','IndexController@getproductview')->name('getproductview');

//123
Route::any('/checkbidless', 'IndexController@checkbidless');
//123

Route::any('/checkbidprice', 'IndexController@checkbidprice');
Route::any('/checkbidbuttonprice', 'IndexController@checkbidbuttonprice');

Route::post('/addbid', 'IndexController@addbid')->name('addbid');

//123
Route::post('/addbidbutton', 'IndexController@addbidbutton')->name('addbidbutton');
//123

Route::get('/showproduct/{token}', 'IndexController@showproduct');
Route::any('/deletetoken', 'IndexController@deletetoken')->name('deletetoken');



Route::get('/editProfile','UserController@EditProfile');
Route::post('/updateprofile','UserController@UpdtaeProfile');
Route::get('/changepassword','UserController@changepassword');
Route::post('/updatePassword','UserController@updatePassword')->name('updatePassword');
Route::get('/fund','UserController@fund');

Route::post('/addamount','Addmoney@postPaymentWithpaypal')->name('addamount');
Route::get('/paypal', array('as' => 'status','uses' => 'Addmoney@getPaymentStatus'));


Route::get('/billinginfo','UserController@billinginfo');
Route::post('/editbillinginfo','UserController@editbillinginfo')->name('editbillinginfo');
//Route::any('/showproduct', 'IndexController@showproduct');

//Route::any('/checkbidtable', 'IndexController@checkbidtable');