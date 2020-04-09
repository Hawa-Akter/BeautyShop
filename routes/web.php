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

Route::get('/', 'WelcomeController@viewIndex');
Route::get('/admin', 'AdminWelcomeController@showDashboard');


//customer product purchasing and visiting routes
Route::get('/view-products', 'WelcomeController@viewAllProduct');
Route::post('/rating-on-product', 'ProductController@storeRatingOnProduct');
Route::get('/add-to-cart/{slug}', 'ProductController@AddProductToCart');
Route::post('/update-cart', 'ProductController@updateCart');
Route::get('/cart-products', 'ProductController@CartPage');
Route::get('/remove-from-cart/{rowId}', 'ProductController@removeCartProduct');
Route::get('/decrese-from-cart/{rowId}', 'ProductController@decreseCartProduct');
Route::get('/show-checkout-content', 'ProductController@showCheckOut');
Route::post('/submit-review', 'ProductController@newReview');
Route::get('/category/{slug}/{slug2}', 'WelcomeController@SubCategoryProducts');
Route::get('/brand/{slug}', 'WelcomeController@BrandProducts');
Route::get('/search-by-range', 'WelcomeController@searchProduct');
Route::get('/print-invoice/{id}', 'OrderController@printInvoice');
Route::get('/public-account', 'HomeController@showCustomerProfile');
Route::post('/save-withdraw', 'HomeController@saveWithDraw');
Route::get('/view-beautitians', 'HomeController@beautitans');
Route::get('/profile-details/{id}', 'HomeController@beautitianDetailsById');
Route::post('/rating-on-beautitian', 'HomeController@storeRatingOnbeautitian');



//admin-product routes
Route::get('/beautyProduct', 'ProductController@showProducts');
Route::post('/subcategorybyid', 'ProductController@subcategories');
Route::post('/new-product', 'ProductController@newProduct');
Route::get('/edit-product/{slug}', 'ProductController@editProductInfo');
Route::post('/update-product', 'ProductController@updateProductInfo');
Route::get('/publish-product/{slug}', 'ProductController@publishProductInfo');
Route::get('/unPublish-product/{slug}', 'ProductController@unPublishProductInfo');
Route::get('/product-details/{slug}', 'ProductController@viewProductDetails');
Route::get('/all-order', 'OrderController@viewOrder');
Route::get('/confirm-delivery/{id}', 'OrderController@confirmOrderDelivery');
Route::get('/view-order-details/{id}', 'OrderController@viewOrderDetails');
Route::get('/market-order', 'OrderController@allMarketOrder');
Route::get('/view-Market-order-details/{id}', 'OrderController@viewOrderDetailsOfMarket');
Route::post('/save-beautitian', 'AdminWelcomeController@setBeautitian');
Route::get('/add-new-beautitian', 'AdminWelcomeController@viewAddBeautitian');
Route::get('/all-users', 'AdminWelcomeController@viewAllUser');



//Category routes
Route::get('/productCategories', 'CategoryController@viewCategories');
Route::post('/new-category', 'CategoryController@NewCategory');
Route::get('/edit-category/{slug}', 'CategoryController@editCategory');
Route::post('/update-category', 'CategoryController@updateCategoryInfo');
Route::get('/publish-category/{slug}', 'CategoryController@publishCategoryInfo');
Route::get('/unPublish-category/{slug}', 'CategoryController@unPublishCategoryInfo');

//Sub category routes
Route::get('/productSubCategories', 'CategoryController@viewSubCategories');
Route::post('/new-sub-category', 'CategoryController@newSubCategory');
Route::get('/edit-sub-category/{slug}', 'CategoryController@editSubCategory');
Route::post('/update-sub-category', 'CategoryController@updateSubCategoryInfo');
Route::get('/publish-sub-category/{slug}', 'CategoryController@publishSubCategoryInfo');
Route::get('/unPublish-sub-category/{slug}', 'CategoryController@unPublishSubCategoryInfo');


//Brand routes
Route::get('/manage-brand', 'BrandController@viewBrand');
Route::post('/new-brand', 'BrandController@newBrand');
Route::get('/edit-brand/{slug}', 'BrandController@editBrandInfo');
Route::post('/update-brand', 'BrandController@updateBrandInfo');
Route::get('/publish-brand/{slug}', 'BrandController@publishBrandInfo');
Route::get('/unPublish-brand/{slug}', 'BrandController@unPublishBrandInfo');


Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->middleware('verified');


//wishlist routes
Route::get('/add-to-wishlist/{slug}', 'WishlistController@addProductToWishlist');
Route::get('/wishlist', 'WishlistController@viewWishlist');
Route::get('/del-wishlist/{id}/{rowId}', 'WishlistController@delItemfromWishlist');


//Blog routes
Route::get('/blog', 'BlogController@ViewBlog');
Route::post('/new-blog', 'BlogController@addNewBlog');
Route::post('/update-blog', 'BlogController@UpdateBlog');
Route::get('/details-blog/{slug}', 'BlogController@blogDetailsById');
Route::post('/new-comment', 'BlogController@createComment');
Route::get('/delete-blog/{slug}', 'BlogController@deleteBlog');

//market place routes
Route::get('/market-place', 'MarketController@viewMarketPlace');
Route::post('/new-market-product', 'MarketController@newMarketProduct');
Route::get('/market-product-details/{slug}', 'MarketController@viewProductDetails');
Route::get('/market-add-to-cart/{slug}', 'MarketController@AddProductToCart');
Route::get('/market-cart-products', 'MarketController@CartPage');
Route::get('/remove-from-market-cart/{rowId}', 'MarketController@removeCartProductOfMarket');
Route::get('/market-checkout-content', 'MarketController@showMarketCheckOut');
Route::post('/confirm-market-order', 'MarketController@confirmPurchase');
Route::get('/market-print-invoice/{id}', 'MarketController@printMarketInvoice');
Route::get('/confirm-market-delivery/{id}', 'OrderController@confirmMarketOrderDelivery');
Route::post('/update-marketCart', 'MarketController@updateCart');

//profile routes
Route::get('/my-account', 'HomeController@ProfileView');
Route::post('/edit-profile', 'HomeController@UpdateProfile');


//order routes
Route::post('/confirm-order', 'OrderController@ConfirmOrder');



//compare routes
Route::get('/show-compare-product', 'WishlistController@showCompare');
Route::get('/add-to-compare/{slug}', 'WishlistController@addToCompare');
Route::post('/add-my-compare', 'WishlistController@addMyCompare');
Route::get('/removefromcompare/{id}', 'WishlistController@removeCompare');