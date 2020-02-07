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
    Route::get('cities/{provinceId}','RegisterController@getAllCities');
    Route::get('provinces','RegisterController@getAllProvinces');
    Route::get('/product/{id}','Frontend\ProductController@apiGetProduct');
    Route::get('/sort-product/{id}/{sort}/{paginate}','Frontend\ProductController@apiGetSortProduct');
    Route::get('/category-attribute/{id}','Frontend\ProductController@apiGetCategoryAttributeGroups');
    Route::get('/filter-product/{id}/{sort}/{paginate}/{attribute}','Frontend\ProductController@apiGetFilterProuct');
    Route::get('/likeCheck/{id}','Frontend\PostController@apiLikeCheck');
    Route::get('post-like/{id}', 'Frontend\PostController@postLike')->name('post.like');
    Route::get('post-dislike/{id}', 'Frontend\PostController@postDislike')->name('post.dislike');
    Route::get('post-like-count/{id}', 'Frontend\PostController@apiLikeCount');
    Route::get('productlikeCheck/{id}','Frontend\ProductController@apiLikeCheck');
    Route::get('product-like/{id}', 'Frontend\ProductController@productLike');
    Route::get('product-dislike/{id}', 'Frontend\ProductController@productDislike');
    Route::get('search-catProduct/{id}/{item}/{sort}/{paginate}', 'Frontend\ProductController@searchProductInCategory');
    Route::get('brand-filter-product/{id}/{sort}/{paginate}/{brand}', 'Frontend\ProductController@brandFilterProduct');


});

Route::middleware(['admin'])->group(function(){
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
        Route::get('orders','Admin\OrderController@index')->name('order.index');
        Route::get('orderList/{id}','Admin\OrderController@orderList')->name('order.list');
        Route::resource('user','Admin\UserController');
        Route::post('logout','Admin\LoginController@logout')->name('admin.logout');
        Route::get('resetForm','Admin\ResetPasswordController@showResetForm')->name('admin.password.index');
        Route::post('resetPassword','Admin\ResetPasswordController@reset')->name('admin.password.update');
        Route::resource('post','Admin\PostController');
    });
});
Route::group(['middleware'=>'auth'], function() {
    Route::get('profile', 'Frontend\UserController@profile')->name('user.profile');
    Route::post('addCoupon', 'Frontend\CouponController@addCoupon')->name('coupon.add');
    Route::get('order-verify', 'Frontend\OrderController@verify')->name('order.verify');
    Route::get('payment-verify/{id}', 'Frontend\PaymentController@verify')->name('payment.verify');
    Route::get('profile/orders', 'Frontend\OrderController@index')->name('profile.order.index');
    Route::get('profile/order-list/{id}', 'Frontend\OrderController@orderList')->name('profile.order.list');

});

Route::resource('/','Frontend\HomeController');
Route::post('/register','Frontend\UserController@register')->name('user.register');
Route::get('add_to_cart/{id}','Frontend\CartController@AddToCart')->name('cart.add');
Route::post('remove_item/{id}','Frontend\CartController@RemoveItem')->name('cart.remove');
Route::get('cart','Frontend\CartController@getCart')->name('cart.cart');
Route::get('product/{slug}','Frontend\ProductController@getProduct')->name('product.single');
Route::get('category/{slug}', 'Frontend\ProductController@getProductByCategory')->name('category.productShow');
Route::post('comment/{id}', 'Frontend\CommentController@store')->name('frontend.comment.store');
Route::post('comment', 'Frontend\CommentController@reply')->name('frontend.comment.reply');
Route::get('loginForm', 'Admin\LoginController@showLoginForm');
Route::post('adminDashboard', 'Admin\LoginController@login')->name('admin.login');
Route::get('searchProduct', 'Frontend\ProductController@searchTitle')->name('frontend.search.product');
Route::get('showPost/{slug}', 'Frontend\PostController@show')->name('frontend.post.show');
Route::post('/rating/{product}', 'Frontend\ProductController@productStar')->name('productStar');
