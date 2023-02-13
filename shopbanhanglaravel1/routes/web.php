<?php
use Illuminate\Support\Facades\Route;
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
//Frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::post('/tim-kiem', 'HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProductController@show_category_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductsController@details_product');
//Thương hiệu sản phẩm trang chủ
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProductController@show_brand_home');

//Backend
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');


//Category Product
Route::get('/add-category-product','CategoryProductController@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProductController@delete_category_product');
Route::get('/all-category-product','CategoryProductController@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProductController@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProductController@active_category_product');

Route::post('/save-category-product','CategoryProductController@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProductController@update_category_product');

//Brands Product
Route::get('/add-brand-product', 'BrandProductController@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProductController@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProductController@delete_brand_product');
Route::get('/all-brand-product', 'BrandProductController@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProductController@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProductController@active_brand_product');

Route::post('/save-brand-product', 'BrandProductController@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'BrandProductController@update_brand_product');

//Products
Route::get('/add-product', 'ProductsController@add_product');
Route::get('/edit-product/{product_id}', 'ProductsController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductsController@delete_product');
Route::get('/all-product', 'ProductsController@all_product');

Route::get('/unactive-product/{product_id}', 'ProductsController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductsController@active_product');

Route::post('/save-product', 'ProductsController@save_product');
Route::post('/update-product/{product_id}', 'ProductsController@update_product');

//Cart
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/save-cart', 'CartController@save_cart');
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');

//Checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/checkout', 'CheckoutController@checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::post('/order-place', 'CheckoutController@order_place');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');

//Manage
Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'CheckoutController@view_order');

//Send Mail
Route::get('/send-mail', 'HomeController@send_mail');

//Login Facebook
Route::get('/login-facebook', 'AdminController@login_facebook');
Route::get('/admin/callback', 'AdminController@callback_facebook');

//Login google
Route::get('/login-google', 'AdminController@login_google');
Route::get('/google/callback', 'AdminController@callback_google');








