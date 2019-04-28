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

Route::get('/','IndexController@index');
	Route::get('getFloorInfo','IndexController@getFloorInfo');

	//登陆路由
	Route::get('login', function () {
    return view('Login.login');
});
	
	//注册路由
	Route::get('register', function () {
    return view('Login.register');
});
	Route::post('doRegister','LoginController@doRegister');
	Route::post('checkEmail','LoginController@checkEmail');
	Route::post('sendEmail','LoginController@sendEmail');
	Route::post('sendPhone','LoginController@sendPhone');
	Route::post('checkPhone','LoginController@checkPhone');
	Route::post('doLogin','LoginController@doLogin');
	Route::get('logout','LoginController@logout');

	// Route::prefix('GoodsController')->group(function(){
	Route::get('detail','GoodsController@detail');
	Route::get('goodslist','GoodsController@goodslist');
	Route::get('cart','GoodsController@cart');
	Route::get('countTotal','GoodsController@countTotal');
	Route::get('pay','GoodsController@pay');
	Route::get('success','GoodsController@success');
	Route::get('address','GoodsController@address');
	Route::post('getarea','GoodsController@getarea');
	Route::post('addressadd','GoodsController@addressadd');


	

	
	

	


	
// });
	// -------------------------------
// Route::get('/index',function(){
// 	echo "<form action='do' method='post'><input type='text' ><button>提交</button></form>";
// });
// Route::post('/do',function(){
// 	echo 456;
// });
// Route::get('/goods/{id}',function($id){
// echo " ID is:".$id;
// });

// Route::get('/form',function(){
// 	return '<form action="add" method="post">'.csrf_field().'<input type="type" name="name_admin" ><button>提交</button></form>';
// });
// Route::post('/add','IndexController@add');
// Route::match(['get','post'],'/add/{id?}',function($id=0){
// 	return 'id='.$id;
// })->where('id','\d+');

// Route::get('user/{name?}',function($name=null){
// 	return $name;
// });

// Route::get('/index',function(){
// 	return view('demo');
// 	301永久从定向
// 	302临时从定向 
// 	@csrf
// 	永久标称临时会影响排名 pv  7 8就可以verymoney了
// });
// Route::get("user/add",function(){
// 	return view('users/add');
// });->middleware('CheckLogin')
// Route::prefix('user')->group(function(){
// 	Route::get('add','UserController@add');
// 	Route::post('addHandle','UserController@addHandle');
// 	Route::get('index','UserController@index');
// 	Route::get('del','UserController@del');
// 	Route::get('edit','UserController@edit');
// 	Route::post('editHandle','UserController@editHandle');
// 	Route::post('checkName','UserController@checkName');
// });
// 	Route::get('login', function () {
//     return view('user.login');
// });
// 	Route::post('doLogin','UserController@doLogin');

// //考试模块
// Route::prefix('webnet')->middleware('CheckLogin')->group(function(){
// 	Route::get('add','Webnet@add');
// 	Route::post('addHandle','Webnet@addHandle');
// 	Route::get('index','Webnet@index');
// 	Route::get('del','Webnet@del');
// 	Route::get('edit','Webnet@edit');
// 	Route::post('editHandle','Webnet@editHandle');
// 	Route::get('checkName','Webnet@checkName');
// });
// 	Route::get('login', function () {
//     return view('webnet.login');
// });
// 	Route::post('doLogin','Webnet@doLogin');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
