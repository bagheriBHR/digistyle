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
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->group(function (){
    Route::get('categories','Admin\CategoryController@apiIndex');
    Route::post('categories/attribute','Admin\CategoryController@apiIndexAttribute');
    Route::get('cities/{provinceId}','Auth\RegisterController@getAllCities');
});

//Route::group(['auth' => 'admin'],function (){
    Route::prefix('admin')->group(function (){
        Route::get('/','Admin\MainController@index')->name('main.index');
        Route::resource('category','Admin\CategoryController');
        Route::post('category/{id}/setting','Admin\CategoryController@addSetting')->name('category.addSetting');
        Route::get('category/{id}/setting','Admin\CategoryController@createSetting')->name('category.createSetting');
        Route::resource('attributeGroup','Admin\AttributeGroupController');
        Route::resource('attributeValue','Admin\AttributeValueController');
        Route::resource('brand','Admin\BrandController');
        Route::post('upload','Admin\PhotoController@upload')->name('photo.upload');
        Route::resource('product','Admin\ProductController');
        Route::resource('coupon','Admin\CouponController');
        Route::resource('comment','Admin\CommentController');
        Route::get('comment/action/{id}','Admin\CommentController@action')->name('comment.action');

    });
//});
Route::group(['middleware'=>'auth'], function() {
    Route::get('profile', 'Frontend\UserController@profile')->name('user.profile');
    Route::post('addCoupon', 'Frontend\CouponController@addCoupon')->name('coupon.add');
});

Route::resource('/','Frontend\HomeController');
Route::post('/register','Frontend\UserController@register')->name('user.register');
Route::get('add_to_cart/{id}','Frontend\CartController@AddToCart')->name('cart.add');
Route::post('remove_item/{id}','Frontend\CartController@RemoveItem')->name('cart.remove');
Route::get('cart','Frontend\CartController@getCart')->name('cart.cart');
Route::get('product/{slug}','Frontend\ProductController@getProduct')->name('product.single');
Route::post('/rating/{product}', 'Frontend\ProductController@productStar')->name('productStar');
Route::get('category/{slug}', 'Frontend\ProductController@getProductByCategory')->name('category.productShow');
Route::post('comment/{id}', 'Frontend\CommentController@store')->name('frontend.comment.store');
Route::post('comment', 'Frontend\CommentController@reply')->name('frontend.comment.reply');
