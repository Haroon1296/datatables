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

Route::get('/admin', 'admin\LoginController@index');
Route::post('admin/login','admin\LoginController@loginpost')->name('admin.login.post');

Route::group(['middleware' => 'auth'], function(){

    Route::get('admin/logout','admin\LoginController@logout');

    Route::get('/home', 'admin\HomeController@index');
    Route::get('Seller/Products', 'admin\ProductsController@sellerProducts');
    Route::get('Banner/index/{position}', 'admin\BannerController@index');
    Route::get('admin/category/featured/{id}', 'admin\CategoryController@featured');
    Route::get('admin/sellerProducts/featured/{id}', 'admin\ProductsController@featured');
    Route::get('admin/slider/published/{id}', 'admin\SliderController@published');
    Route::get('admin/banner1/published/{id}', 'admin\BannerController@published');
    Route::get('admin/customer/isActive/{id}', 'admin\CustomersController@isActive');

    Route::get('admin/flashDeal/update_status/{id}', 'admin\FlashDealController@update_status');
    Route::post('/flash_deals/product_discount', 'admin\FlashDealController@product_discount')->name('flash_deals.product_discount');
	Route::post('/flash_deals/product_discount_edit', 'admin\FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
    
    Route::get('admin/sellerProducts/published/{id}', 'admin\ProductsController@published');
    Route::get('admin/sellerProducts/todaysDeal/{id}', 'admin\ProductsController@todaysDeal');
    Route::get('admin/sellerProducts/delete/{id}', 'admin\ProductsController@delete');
    Route::get('admin/custome/delete/{id}', 'admin\CustomersController@delete');
    Route::get('admin/flashDeal/delete/{id}', 'admin\FlashDealController@destroy');
    Route::get('admin/frontendSettings', 'admin\HomeController@frontendSettings');
    Route::get('admin/homeBannerOne', 'admin\HomeController@homeBannerOne');
    Route::get('admin/homeBannerTwo', 'admin\HomeController@homeBannerTwo');
    Route::get('admin/subcategory/child/{id}', 'admin\SubSubCategoryController@subcategoryChange');
    Route::get('admin/userType/users/{userType}', 'admin\NewsletterController@getUsers');
    Route::get('admin/userType/users/selected/{selected}', 'admin\NewsletterController@selectedUsers');
    Route::get('GeneralSetting/logo', 'admin\GeneralSettingController@logo');
    
    Route::post('/logo','admin\GeneralSettingController@storeLogo')->name('generalsettings.logo.store');
	Route::post('/coupon/get_form', 'admin\CouponController@get_coupon_form')->name('coupon.get_coupon_form');

	Route::get('/sellerpolicy/{type}', 'admin\PolicyController@index')->name('sellerpolicy.index');
    Route::get('/returnpolicy/{type}', 'admin\PolicyController@index')->name('returnpolicy.index');
    Route::get('/supportpolicy/{type}', 'admin\PolicyController@index')->name('supportpolicy.index');
    Route::get('/terms/{type}', 'admin\PolicyController@index')->name('terms.index');
    Route::get('/privacypolicy/{type}', 'admin\PolicyController@index')->name('privacypolicy.index');
    
	Route::get('/smtp-settings', 'admin\BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
	Route::post('/env_key_update', 'admin\BusinessSettingsController@env_key_update')->name('env_key_update.update');

    Route::post('/coupon/get_form_edit', 'admin\CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
	Route::post('/flash_deals/update_status', 'admin\FlashDealController@update_status')->name('FlashDeals.update_status');

    Route::post('/subcategories/get_subcategories_by_category', 'admin\SubCategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
    Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'admin\SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');
	Route::post('/products/get_products_by_subsubcategory', 'admin\ProductsController@get_products_by_subsubcategory')->name('products.get_products_by_subsubcategory');

    Route::get('/newsletter', 'admin\NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'admin\NewsletterController@send')->name('newsletters.send');

    // Route::get('productSale/data/', 'admin\HomeController@productSale');

    Route::get('/productSale/data/{productSale}', 'admin\HomeController@productSaleAndStock');
    Route::get('/productStock/data/{productStock}', 'admin\HomeController@productSaleAndStock');

    
    Route::resource('brands', 'admin\BrandController'); // Brand
    Route::resource('Category', 'admin\CategoryController'); // Category   
    Route::resource('SubCategory', 'admin\SubCategoryController'); // SubCategory   
    Route::resource('SubSubCategory', 'admin\SubSubCategoryController'); // Sub-SubCategory   
    Route::resource('Products', 'admin\ProductsController'); // Products  
    Route::resource('Sellers', 'admin\SellersController'); // Sellers  
    Route::resource('Customers', 'admin\CustomersController'); // Customers  
    Route::resource('Profile', 'admin\ProfileController'); // Profile  
    Route::resource('Slider', 'admin\SliderController'); // Slider
    Route::resource('Banner', 'admin\BannerController'); // Banner
    Route::resource('GeneralSetting', 'admin\GeneralSettingController'); // GeneralSetting
    Route::resource('SeoSetting', 'admin\SeoSettingController'); // SeoSetting
    Route::resource('Policies', 'admin\PolicyController'); // Policies
    Route::resource('Coupon', 'admin\CouponController'); // Coupon
    Route::resource('FlashDeals','admin\FlashDealController');  // Flash Deals

});




