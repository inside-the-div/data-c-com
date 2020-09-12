<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['settings'])->group(function () {
  
// get method
Route::get('/','FrontEnd\PublicController@index')->name('website.home');
Route::get('/shop','FrontEnd\EcommerceController@shop')  ->name('website.shop_page');
Route::get('/category/{slug}','FrontEnd\CategoryController@single_category')->name('website.single_category');
Route::get('/check-out', 'FrontEnd\EcommerceController@check_out')->name('website.check_out');

Route::get('/about', 'FrontEnd\PageController@about_page')->name('website.about_page');
Route::get('/condition', 'FrontEnd\PageController@condition_page')->name('website.condition_page');
Route::get('/privacy-policy', 'FrontEnd\PageController@privacy_page')->name('website.privacy_page');
Route::get('/contact', 'FrontEnd\PageController@contact_page')->name('website.contact_page');
Route::post('/contact/email/send', 'FrontEnd\PageController@email_send')->name('website.email.send');

Route::get('/faq', 'FrontEnd\PageController@faq_page')->name('website.faq_page');
Route::get('/help', 'FrontEnd\PageController@help_page')->name('website.help_page');

// post method
Route::post('/search', 'FrontEndController@search')->name('website.search');



// get of cart 

Route::get('/cart', 'FrontEnd\CartController@view_cart')->name('website.cart.view');
Route::get('/check-out', 'FrontEnd\CartController@check_out')->name('website.cart.check_out');


// order submit

Route::post('/order-submit', 'FrontEnd\OrderController@submit')->name('website.order.submit');
Route::get('/confirm', 'FrontEnd\OrderController@confirm')->name('website.order.confirm');




});


Route::post('/add-to-cart', 'FrontEnd\CartController@add_to_cart')->name('website.cart.add');
Route::post('/delete-full-cart', 'FrontEnd\CartController@delete_full_cart')->name('website.cart.delete.full');

Route::post('/create-cart', 'FrontEnd\CartController@create_cart')->name('website.cart.create');

Route::post('/delete-cart-product', 'FrontEnd\CartController@delete_cart_product')->name('website.cart.delete.product');
Route::post('/update-cart', 'FrontEnd\CartController@update_cart')->name('website.cart.update');







// Route::post('/order/store', 'FrontEndController@store_order')->name('website.order.store');


// Route::post('/contact', 'ContactController@SendEmail')->name('website.send.email');
// Route::post('/find-me', 'CartController@find_me')->name('website.cart.findme');




// settings

// Route::middleware(['settings'])->group(function () {

  // Route::get('/', 'PublicController@home')->name('website.home');



  // Route::get('/order-submit', 'FrontEndController@order_submit')->name('website.oder.submit');
  // Route::get('/check-out', 'CartController@check_out')->name('website.check_out');
  // Route::get('/about', 'AboutController@index')->name('website.about');
  // Route::get('/condition', 'ConditionController@index')->name('website.condition');
  // Route::get('/privacy-policy', 'PrivacyController@index')->name('website.privacy');
  // Route::get('/contact', 'ContactController@index')->name('website.contact');


// });





Route::middleware(['auth'])->group(function () {

  Route::post('/review-submit', 'FrontEnd\ReviewController@store')->name('website.review.store');

});













Auth::routes();

// Route::get('/clear_cache', function () {

//     \Artisan::call('cache:clear');

//     dd("Cache is cleared");

// });


Route::group([
	'prefix' => 'admin',
	'middleware' => [
		'auth','admin'
	],
], function (){

   Route::get('/', 'HomeController@index')->name('admin.home');
   Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');

   // orders 
   Route::get('/orders','OrderController@index')->name('admin.orders');
   Route::get('/order/add','OrderController@add')->name('admin.order.add');
   Route::get('/order/show/{id}','OrderController@show')->name('admin.order.show');
   Route::get('/order/invoice/{id}','OrderController@invoice')->name('admin.order.invoice');
   Route::get('/order/edit/{id}','OrderController@edit')->name('admin.order.edit');
   Route::post('/order/store','OrderController@store')->name('admin.order.store');
   Route::post('/order/update','OrderController@update')->name('admin.order.update');
   Route::post('/order/delete','OrderController@delete')->name('admin.order.delete');
   Route::post('/order/confirm','OrderController@confirm')->name('admin.order.confirm');
   Route::post('/order/download','OrderController@download')->name('admin.order.download');

   Route::post('/order/auto_seen','OrderController@seen')->name('admin.order.seen');

   // customers 
   Route::get('/customers','CustomerController@index')->name('admin.customers');
   Route::get('/customer/add','CustomerController@add')->name('admin.customer.add');
   Route::get('/customer/show/{id}','CustomerController@show')->name('admin.customer.show');
   Route::get('/customer/edit/{id}','CustomerController@edit')->name('admin.customer.edit');
   Route::post('/customer/store','CustomerController@store')->name('admin.customer.store');
   Route::post('/customer/update','CustomerController@update')->name('admin.customer.update');
   Route::post('/customer/delete','CustomerController@delete')->name('admin.customer.delete');
   Route::post('/customer/confirm','CustomerController@confirm')->name('admin.customer.confirm');
   Route::post('/customer/download','CustomerController@download')->name('admin.customer.download');

   // products 
   Route::get('/products','ProductController@index')->name('admin.products');
   Route::get('/product/add','ProductController@add')->name('admin.product.add');
   Route::get('/product/show/{slug}','ProductController@show')->name('admin.product.show');
   Route::get('/product/edit/{id}','ProductController@edit')->name('admin.product.edit');
   Route::post('/product/store','ProductController@store')->name('admin.product.store');
   Route::post('/product/update','ProductController@update')->name('admin.product.update');
   Route::post('/product/delete','ProductController@delete')->name('admin.product.delete');
   Route::post('/product/active_deactivated','ProductController@active_deactivated')->name('admin.product.active_deactivated');
   Route::post('/product/home_show_hide','ProductController@home_show_hide')->name('admin.product.home_show_hide');
   Route::post('/product/download','ProductController@download')->name('admin.product.download');

   // categories
   Route::get('/categories','CategoryController@index')->name('admin.categories');
   Route::get('/category/show/{slug}','CategoryController@show')->name('admin.category.show');
   Route::post('/category/store','CategoryController@store')->name('admin.category.store');
   Route::post('/category/update','CategoryController@update')->name('admin.category.update');
   Route::post('/category/delete','CategoryController@delete')->name('admin.category.delete');
   Route::post('/category/download','CategoryController@download')->name('admin.category.download');



   Route::get('/emails','EmailController@index')->name('admin.emails');
   Route::get('/email/show/{id}','EmailController@show')->name('admin.email.show');
   Route::post('/email/store','EmailController@store')->name('admin.email.store');
   Route::post('/email/update','EmailController@update')->name('admin.email.update');
   Route::post('/email/delete','EmailController@delete')->name('admin.email.delete');
   Route::post('/email/download','EmailController@download')->name('admin.email.download');
   Route::post('/email/replay','EmailController@replay')->name('admin.email.replay');

   Route::post('/email/send','EmailController@send')->name('admin.email.send');
   Route::get('/email/send/page','EmailController@send_page')->name('admin.email.send_page');




   



   // reviews
   Route::get('/reviews','ReviewController@index')->name('admin.reviews');
   Route::get('/review/add','ReviewController@add')->name('admin.review.add');
   Route::get('/review/show/{id}','ReviewController@show')->name('admin.review.show');
   Route::get('/review/edit/{id}','ReviewController@edit')->name('admin.review.edit');
   Route::post('/review/store','ReviewController@store')->name('admin.review.store');
   Route::post('/review/update','ReviewController@update')->name('admin.review.update');
   Route::post('/review/delete','ReviewController@delete')->name('admin.review.delete');
   Route::post('/review/active','ReviewController@active')->name('admin.review.active');

   //seo
   Route::get('/seo','SeoController@index')->name('admin.seos');
   Route::post('/seo/home-page','SeoController@home_page')->name('admin.seo.home-page');
   Route::post('/seo/about-page','SeoController@about_page')->name('admin.seo.about-page');
   Route::post('/seo/contact-page','SeoController@contact_page')->name('admin.seo.contact-page');

   // banner
   Route::get('/banner','BannerController@index')->name('admin.banner');

   Route::post('/banner/update','BannerController@update')->name('admin.banner.update');



   // settings
    Route::get('/settings','SettingsController@index')->name('admin.settings');
    Route::post('/settings','SettingsController@update')->name('admin.settings.update');
    Route::post('/settings/seo','SettingsController@seo_update')->name('admin.settings.seo.update');
    Route::post('/settings/social','SettingsController@social_media_update')->name('admin.settings.social_media.update');


    // Route::get('/ecommerce','EcommerceController@index')->name('admin.ecommerce');
    Route::get('/about','AboutController@edit')->name('admin.about');
    Route::get('/contact','ContactController@edit')->name('admin.contact');
    Route::get('/privacy','PrivacyController@edit')->name('admin.privacy');
    Route::get('/condition','ConditionController@edit')->name('admin.condition');

    Route::post('/ecommerce','EcommerceController@update')->name('admin.ecommerce.update');
    Route::post('/ecommerce/payment','EcommerceController@payment_settings')->name('admin.settings.ecommerce.payment');


    Route::post('/about','AboutController@update')->name('admin.about.update');
    Route::post('/contact','ContactController@update')->name('admin.contact.update');
    Route::post('/privacy','PrivacyController@update')->name('admin.privacy.update');
    Route::post('/condition','ConditionController@update')->name('admin.condition.update');


    // profile 
    Route::get('/profile', 'SettingsController@profile')->name('admin.profile');
    Route::post('/profile', 'SettingsController@user_profile_update')->name('admin.profile.update');
    Route::post('/profile/password', 'SettingsController@password_change')->name('admin.profile.password_change');


    // data 
    Route::get('/data','DataController@index')->name('admin.data');
    Route::get('/data/sells','DataController@sells')->name('admin.data.sells');
    Route::post('/data/sells','DataController@sells_download')->name('admin.data.sells.download');

    Route::get('/data/products','DataController@products')->name('admin.data.products');
    Route::post('/data/products','DataController@products_download')->name('admin.data.products.download');

    Route::get('/data/orders','DataController@orders')->name('admin.data.orders');
    Route::post('/data/orders','DataController@orders_download')->name('admin.data.orders.download');




    // report
    Route::get('/reports','ReportController@index')->name('admin.reports');
    Route::post('/reports/order/by/date','ReportController@orders')->name('admin.order.reports');
   









    // notification
    Route::post('/order_notification','NotificationController@order')->name('admin.notification.order');


    // cache 


     
    
});



// cache gorute

Route::post('/clear-cache', 'CacheControl@clear_cache')->name('admin.cache.clear');





Route::group([
   'prefix' => 'customer',
   'middleware' => [
      'auth','customer',
   ],
], function (){

   Route::get('/', 'CustomerDashboardController@index')->name('customer.home');
   Route::get('/order', 'CustomerDashboardController@order')->name('customer.order');
   Route::get('/order/{id}', 'CustomerDashboardController@single')->name('customer.order.single');
   Route::get('/profile', 'CustomerDashboardController@profile')->name('customer.profile');
   Route::get('/profile/edit', 'CustomerDashboardController@profile_edit')->name('customer.profile.edit');
   Route::post('/profile', 'CustomerDashboardController@user_profile_update')->name('customer.profile.update');
   Route::post('/profile/passowrd', 'CustomerDashboardController@password_change')->name('customer.profile.password_change');

   Route::get('/reviews', 'CustomerDashboardController@reviews')->name('customer.reviews');
  
});







Route::middleware(['settings'])->group(function () {
  Route::get('/{slug}', 'FrontEnd\ProductController@single_product')->name('website.single_product');
});