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

/*Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});*/

//Trang Chủ
Route::get('/', 'ShopController@index' );

// Trang liên hệ
Route::get('/lien-he', 'ShopController@contact');

// Trang danh mục
Route::get('/danh-muc-san-pham', 'ShopController@listProducts');

// Trang chi tiết sản phẩm
Route::get('/chi-tiet-san-pham', 'ShopController@detailProduct');

// Trang danh sach tin tuc
Route::get('/tin-tuc', 'ShopController@listArticles');

// Trang chi tiet tin tuc
Route::get('/chi-tiet-tin-tuc', 'ShopController@detailArticle');

//dat hang
Route::get('/dat-hang', 'CartController@index');
//thanh toan
Route::get('/thanh-toan', 'CartController@checkout');

// Đăng nhập
Route::get('/admin/login', 'LoginController@login')->name('admin.login');
// Đăng xuất
Route::get('/admin/logout', 'LoginController@logout')->name('admin.logout');

Route::post('/admin/postLogin', 'LoginController@postLogin')->name('admin.postLogin');

//Gom nhóm route của trang admin thông qua hàm group
Route::group(['prefix' => 'admin','as' => 'admin.'], function() {
// giúp cho chúng ta tạo các url tương ứng với controller...
    Route::resource('category', 'CategoryController');
    Route::resource('banner', 'BannerController');
    Route::resource('vendor', 'VendorController');
    Route::resource('product', 'ProductController');
    Route::resource('user', 'UserController');

});
