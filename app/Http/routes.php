<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('hello',function(){
	echo 'Hello World!';
});

Route::get('/auth/login','AdminController@getLogin');
Route::post('/auth/login','AdminController@postLogin');
Route::get('/login','AdminController@getLogin');
Route::get('/logout' , 'AdminController@getLogout');
Route::get('/active' , 'frontendController@getActive');

Route::get('/register','frontendController@getRegister');
Route::post('/regis','frontendController@postRegister');
// reset password
Route::get('forgetpassword','Auth\PasswordController@getEmail');
Route::post('forgetpassword','Auth\PasswordController@postEmail');
Route::get('password/{token}/{id}','Auth\PasswordController@getNewPassword');
Route::post('password/{token}/{id}','Auth\PasswordController@postNewPassword');

Route::get('/', 'frontendController@index');
//Route::get('/{id}-product', 'frontendController@detail');
Route::get('/product-details/{id}-{slug?}', 'frontendController@detail');
Route::get('/category/{id}/{slug?}','frontendController@category');
Route::get('/search','frontendController@search');

Route::get('/active/{token}/{id}','AdminController@activeaccount');
//comment
Route::any('/review-product/{id}/{number}.html','frontendController@addreview');
Route::get('/del-review/{id}' , 'frontendController@delreview' );
//cart
Route::any('/add-cart/{id}/{number}.html','frontendController@addcart');
Route::get('/delete-cart/{id}.html','frontendController@deleteCart');
Route::get('/cart','frontendController@getCart');
Route::post('/update-cart','frontendController@updatecart');
//checkout
Route::get('/checkout','frontendController@getCheckout');
Route::post('/addOrder','frontendController@addOrder');
//confirm order
Route::get('/confirm-order/{token}/{id}','OrderController@activeOrder');



//////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware'=>'auth'], function(){
	
	Route::group(['prefix'=>'/admin'], function()
	{
		// Route::controller('/', 'adminController');
		Route::get('/','adminController@getIndex');
		Route::resource('/users', 'UserController');
		Route::post('/users/updateAvatar/{id}', 'UserControler@updateAvatar');

		Route::get('/category', 'categoryController@index');
		Route::get('/category/create', 'categoryController@create');
		Route::post('/category/create', 'categoryController@store');
		Route::get('/category/del/{id}', 'categoryController@destroy');

		Route::get('/category/update/{id}', 'categoryController@edit');
		Route::post('/category/update/{id}', 'categoryController@update');

		Route::get('/addRole', 'AdminController@getAddRole');
		Route::post('addRole', 'AdminController@postAddRole');
		Route::get('/updateRole', 'AdminController@getUpdateRole');
		Route::post('updateRole', 'AdminController@postUpdateRole');
		Route::get('/deleteRole', 'AdminController@getDeleteRole');
		Route::post('deleteRole', 'AdminController@postDeleteRole');

		Route::resource('/product','ProductController');
		Route::get('/product/{id}/del','ProductController@getDelete');

		Route::resource('/slider','SliderController');

		Route::resource('/news','NewsController');

		Route::get('uploadimg', 'UploadController@index');

		//order
		Route::resource('order','OrderController');
	});

});
/////////////////////////////////////////////////////////////////////////////////////////////

// News
Route::get('news','frontendController@news');
Route::get('contact', 'frontendController@contact');
Route::get('/news/{id}-{slug?}', 'frontendController@post');
Route::any('/review-news/{id}/{number}.html','frontendController@newsComment');
Route::get('/del-review-news/{id}' , 'frontendController@delreviewNews');
Route::get('tetris','frontendController@tetris');
Route::get('chat','frontendController@chat');
Route::get('tu-van', 'frontendController@recommend');
Route::post('recommend','frontendController@recommend_analyze');