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

// Register authentication routes
Auth::routes(['verify' => true]);
Route::middleware(['auth'])->get('logout', 'Auth\LoginController@logout');

Route::post('password/change', 'Auth\LoginController@reset_password')->name('store_new_password');
use App\Http\Controllers\Admin\Calcultor\SalaryCalculatorController;
use App\Http\Controllers\Website\SalaryAjaxController as WebsiteSalaryAjaxController;
use App\Http\Controllers\Admin\InsightCalculator\SalaryInsightController;

// retrieve home page
Route::group(['namespace'=>'Website', 'middleware' => []], function () { 
    // Basi routes
    Route::get('/', 'HomeController@home');
    Route::get('welcome', 'HomeController@welcome');
    Route::get('about', 'HomeController@about');
    Route::get('services', 'HomeController@services');
    Route::get('services/{slug}', 'HomeController@services_single');
    Route::get('team', 'HomeController@team');
    Route::get('team/{slug}', 'HomeController@team_single');
    Route::get('contact', 'HomeController@contact');
    Route::get('exactehrm/payrollite/salary-calculator', 'SalaryCalculatorController@index');
    Route::post('/calc-salary', [SalaryAjaxController::class, 'calculate']);
   

Route::post('/salary/calc', [WebsiteSalaryAjaxController::class, 'calculate'])
    ->name('salary.calc');

    Route::get('approach/{approach}', 'ApproachController@ad_hoc_hr_services');
    Route::get('approach/out-sourced-hr-services', 'ApproachController@out_sourced_hr_services');
    Route::get('approach/retained-hr-services', 'ApproachController@retained_hr_services');


    Route::get('page/{slug}', 'HomeController@page');
    Route::get('switch-languege/{lang}', 'HomeController@switch_languege');
    Route::get('download-old-posts', 'HomeController@download_old_posts');
    Route::get('download/{filename}', 'HomeController@download');

    Route::get('get_updated_with/{post_type_id}', 'BlogController@index');
    Route::get('get_updated_with/category/{category_id}', 'BlogController@index');
    Route::get('get_updated_with/post/{post_id}', 'BlogController@single');
    Route::middleware(['auth'])->post('blog/{post_id}/comment', 'BlogController@comment');
});


Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => ['account', 'auth']], function () {
    
    // retrieve home page
    Route::middleware([])->get('/profile', 'ProfileController@profile');
    Route::middleware([])->post('/profile', 'ProfileController@profile_update');
    Route::middleware([])->post('/profile-image', 'ProfileController@profile_image_update');

    // retrieve home page
    Route::middleware([])->get('/change-password', 'ProfileController@change_password');
    Route::middleware([])->post('/change-password', 'ProfileController@change_password_store');

    // -------------------- Start routes for module Dashboard --------------------- //
    Route::group([], function () {
        Route::middleware(['admin'])->get('/', 'DashboardController@index'); // Retrieve list of Dashboards
        Route::middleware(['admin'])->get('/dashboard', 'DashboardController@index');// Delete specific Dashboard by ID
    });
    // -------------------- End routes invoive Dashboard --------------------- //


    // -------------------- Start routes for module Manage User --------------------- //
    Route::group(['prefix'=>'manage-users', 'namespace'=>'ManageUser'], function () {
        
        
        Route::middleware(['admin'])->get('/users/list', 'UserController@index'); // Retrieve list of Users
        Route::middleware(['admin'])->get('/users/api-list', 'UserController@index_api'); // Retrieve list of json Users 
        Route::middleware(['admin'])->get('/users/create', 'UserController@create'); // Display form TO add User
        Route::middleware(['admin'])->post('/users/store', 'UserController@store'); // Save new User
        Route::middleware(['admin'])->get('/users/show/{id}/{sub_page?}', 'UserController@show'); // Retrieve specific User data by ID
        Route::middleware(['admin'])->get('/users/edit/{id}', 'UserController@edit'); // Retrieve edit form for specific User
        Route::middleware(['admin'])->post('/users/update/{id}', 'UserController@update'); // Update specific User data by ID
        Route::middleware(['admin'])->get('/users/delete/{id}', 'UserController@destroy'); // Delete specific User by ID
        
        
        Route::middleware(['admin'])->get('/logs/list', 'LogController@index'); // Retrieve list of Logs
        Route::middleware(['admin'])->get('/logs/api-list', 'LogController@index_api'); // Retrieve list of json Logs 
        Route::middleware(['admin'])->get('/logs/create', 'LogController@create'); // Display form TO add Log
        Route::middleware(['admin'])->post('/logs/store', 'LogController@store'); // Save new Log
        Route::middleware(['admin'])->get('/logs/show/{id}/{sub_page?}', 'LogController@show'); // Retrieve specific Log data by ID
        Route::middleware(['admin'])->get('/logs/edit/{id}', 'LogController@edit'); // Retrieve edit form for specific Log
        Route::middleware(['admin'])->post('/logs/update/{id}', 'LogController@update'); // Update specific Log data by ID
        Route::middleware(['admin'])->get('/logs/delete/{id}', 'LogController@destroy'); // Delete specific Log by ID
        
        
        Route::middleware(['admin'])->get('/user-logs/list', 'UserLogController@index'); // Retrieve list of User Logs
        Route::middleware(['admin'])->get('/user-logs/api-list', 'UserLogController@index_api'); // Retrieve list of json User Logs 
        Route::middleware(['admin'])->get('/user-logs/create', 'UserLogController@create'); // Display form TO add User Log
        Route::middleware(['admin'])->post('/user-logs/store', 'UserLogController@store'); // Save new User Log
        Route::middleware(['admin'])->get('/user-logs/show/{id}/{sub_page?}', 'UserLogController@show'); // Retrieve specific User Log data by ID
        Route::middleware(['admin'])->get('/user-logs/edit/{id}', 'UserLogController@edit'); // Retrieve edit form for specific User Log
        Route::middleware(['admin'])->post('/user-logs/update/{id}', 'UserLogController@update'); // Update specific User Log data by ID
        Route::middleware(['admin'])->get('/user-logs/delete/{id}', 'UserLogController@destroy'); // Delete specific User Log by ID
        
    });
    // -------------------- End routes invoive Manage User --------------------- //

    // -------------------- Start routes for module Post --------------------- //
    Route::group(['prefix'=>'posts', 'namespace'=>'Post', 'excluded_middleware' => ['auth']], function () {
        
        // Route::get('/posts/list', 'PostController@index'); // Retrieve list of Posts
        // Route::get('/posts/api-list', 'PostController@index_api'); // Retrieve list of json Posts 
        // Route::get('/posts/create', 'PostController@create'); // Display form TO add Post
        // Route::post('/posts/store', 'PostController@store'); // Save new Post
        // Route::get('/posts/show/{id}/{sub_page?}', 'PostController@show'); // Retrieve specific Post data by ID
        // Route::get('/posts/edit/{id}', 'PostController@edit'); // Retrieve edit form for specific Post
        // Route::post('/posts/update/{id}', 'PostController@update'); // Update specific Post data by ID
        // Route::get('/posts/delete/{id}', 'PostController@destroy'); // Delete specific Post by ID
        

        Route::get('/post-types/list', 'PostTypeController@index'); // Retrieve list of Post Types
        Route::get('/post-types/api-list', 'PostTypeController@index_api'); // Retrieve list of json Post Types 
        Route::get('/post-types/create', 'PostTypeController@create'); // Display form TO add Post Type
        Route::post('/post-types/store', 'PostTypeController@store'); // Save new Post Type
        Route::get('/post-types/show/{id}/{sub_page?}', 'PostTypeController@show'); // Retrieve specific Post Type data by ID
        Route::get('/post-types/edit/{id}', 'PostTypeController@edit'); // Retrieve edit form for specific Post Type
        Route::post('/post-types/update/{id}', 'PostTypeController@update'); // Update specific Post Type data by ID
        Route::get('/post-types/delete/{id}', 'PostTypeController@destroy'); // Delete specific Post Type by ID
        
        
        Route::get('/post-comments/list', 'PostCommentController@index'); // Retrieve list of Post Comments
        Route::get('/post-comments/api-list', 'PostCommentController@index_api'); // Retrieve list of json Post Comments 
        Route::get('/post-comments/create', 'PostCommentController@create'); // Display form TO add Post Comment
        Route::post('/post-comments/store', 'PostCommentController@store'); // Save new Post Comment
        Route::get('/post-comments/show/{id}/{sub_page?}', 'PostCommentController@show'); // Retrieve specific Post Comment data by ID
        Route::get('/post-comments/edit/{id}', 'PostCommentController@edit'); // Retrieve edit form for specific Post Comment
        Route::post('/post-comments/update/{id}', 'PostCommentController@update'); // Update specific Post Comment data by ID
        Route::get('/post-comments/delete/{id}', 'PostCommentController@destroy'); // Delete specific Post Comment by ID
        

        Route::get('/post/stauts/{status}/{id}', 'PostController@status');
        Route::get('/{post_type_id}/stauts/{status}/{id}', 'PostController@status');
        Route::get('/{post_type_id}/list', 'PostController@index');
        Route::get('/{post_type_id}/view_list_changed', 'PostController@view_type')->name('change_view_list');
        Route::post('/{post_type_id}/custom_view', 'PostController@custom_arrangement')->name('custom_arrangement');
        Route::get('/{post_type_id}/api-list', 'PostController@index_api');
        Route::get('/{post_type_id}/create', 'PostController@create');
        Route::post('/{post_type_id}/store', 'PostController@store');
        Route::get('/{post_type_id}/show/{id}/{sub_page?}', 'PostController@show');
        Route::get('/{post_type_id}/edit/{id}', 'PostController@edit');
        Route::post('/{post_type_id}/update/{id}', 'PostController@update');
        Route::post('/{post_type_id}/comment/{id}', 'PostController@comment');
        Route::get('/{post_type_id}/delete/{id}', 'PostController@destroy');
    });

    //Route::group(['namespace'=>'Website', 'middleware' => []], function () { 
    // Route::group(['namespace'=>'Post', 'middleware' => []], function () {
        
    // });

    //Route::post('posts/{post_type_id}/comment/{id}', 'HomeController@comment');
    //Route::post('comment/{post_type_id}/update/{id}', 'PostController@comment')->name('comment');


    //Route::post('comment/{id}', 'PostController@comment')->name('');
    // -------------------- End routes invoive Post --------------------- //

    //----------------------Start home page edit------------------------- //
        Route::middleware(['admin'])->get('/posts/home/slider/index', 'Home\EditHomeController@index')->name('slider');
        Route::middleware(['admin'])->get('/posts/home/slider-list', 'Home\EditHomeController@list')->name('slider-list');
        Route::middleware(['admin'])->get('/posts/home/slider/create', 'Home\EditHomeController@create')->name('slider-create');
        Route::middleware(['admin'])->post('/posts/home/slider/create', 'Home\EditHomeController@store')->name('slider-store');
        Route::middleware(['admin'])->get('slider-delete/{id}', 'Home\EditHomeController@destroy')->name('slider-delete');
        Route::middleware(['admin'])->get('/posts/home/slider/show/{id}', 'Home\EditHomeController@show');
        Route::middleware(['admin'])->get('/posts/home/slider/edit/{id}', 'Home\EditHomeController@edit')->name('slider-edit');
        Route::middleware(['admin'])->post('/posts/home/slider/publish/{id}', 'Home\EditHomeController@publish');
    //End routes for home page edit


//............................... start insight calvulator.............................//

    Route::group(['prefix'=>'calculator', 'namespace'=>'Calculator'], function () {
        
        
        Route::middleware(['admin'])->get('/insightLogs/list', [SalaryInsightController::class ,'insight']);     
        Route::middleware(['admin'])->get('/taxRate/show', [SalaryInsightController::class ,'taxrate']);
        Route::middleware(['admin'])->put('/taxRate/update/{id}', [SalaryInsightController::class ,'update']);
   
        
    });
//................................ End of insight.......................................//

    // -------------------- Start routes for module Tag --------------------- //
    Route::group(['prefix'=>'tags', 'namespace'=>'Tag'], function () {
        
        
        Route::middleware(['admin'])->get('/tags/list', 'TagController@index'); // Retrieve list of Tags
        Route::middleware(['admin'])->get('/tags/api-list', 'TagController@index_api'); // Retrieve list of json Tags 
        Route::middleware(['admin'])->get('/tags/create', 'TagController@create'); // Display form TO add Tag
        Route::middleware(['admin'])->post('/tags/store', 'TagController@store'); // Save new Tag
        Route::middleware(['admin'])->get('/tags/show/{id}/{sub_page?}', 'TagController@show'); // Retrieve specific Tag data by ID
        Route::middleware(['admin'])->get('/tags/edit/{id}', 'TagController@edit'); // Retrieve edit form for specific Tag
        Route::middleware(['admin'])->post('/tags/update/{id}', 'TagController@update'); // Update specific Tag data by ID
        Route::middleware(['admin'])->get('/tags/delete/{id}', 'TagController@destroy'); // Delete specific Tag by ID
        
        
        Route::middleware(['admin'])->get('/tag-types/list', 'TagTypeController@index'); // Retrieve list of Tag Types
        Route::middleware(['admin'])->get('/tag-types/api-list', 'TagTypeController@index_api'); // Retrieve list of json Tag Types 
        Route::middleware(['admin'])->get('/tag-types/create', 'TagTypeController@create'); // Display form TO add Tag Type
        Route::middleware(['admin'])->post('/tag-types/store', 'TagTypeController@store'); // Save new Tag Type
        Route::middleware(['admin'])->get('/tag-types/show/{id}/{sub_page?}', 'TagTypeController@show'); // Retrieve specific Tag Type data by ID
        Route::middleware(['admin'])->get('/tag-types/edit/{id}', 'TagTypeController@edit'); // Retrieve edit form for specific Tag Type
        Route::middleware(['admin'])->post('/tag-types/update/{id}', 'TagTypeController@update'); // Update specific Tag Type data by ID
        Route::middleware(['admin'])->get('/tag-types/delete/{id}', 'TagTypeController@destroy'); // Delete specific Tag Type by ID
        
    });
    // -------------------- End routes invoive Tag --------------------- //

    // -------------------- Start routes for module Subscription --------------------- //
    Route::group([], function () {
        
        
        Route::middleware(['admin'])->get('/subscription-types/list', 'SubscriptionTypeController@index'); // Retrieve list of Subscription Types
        Route::middleware(['admin'])->get('/subscription-types/api-list', 'SubscriptionTypeController@index_api'); // Retrieve list of json Subscription Types 
        Route::middleware(['admin'])->get('/subscription-types/create', 'SubscriptionTypeController@create'); // Display form TO add Subscription Type
        Route::middleware(['admin'])->post('/subscription-types/store', 'SubscriptionTypeController@store'); // Save new Subscription Type
        Route::middleware(['admin'])->get('/subscription-types/show/{id}/{sub_page?}', 'SubscriptionTypeController@show'); // Retrieve specific Subscription Type data by ID
        Route::middleware(['admin'])->get('/subscription-types/edit/{id}', 'SubscriptionTypeController@edit'); // Retrieve edit form for specific Subscription Type
        Route::middleware(['admin'])->post('/subscription-types/update/{id}', 'SubscriptionTypeController@update'); // Update specific Subscription Type data by ID
        Route::middleware(['admin'])->get('/subscription-types/delete/{id}', 'SubscriptionTypeController@destroy'); // Delete specific Subscription Type by ID
        
    });
    // -------------------- End routes invoive Subscription --------------------- //
    // ------------------- start salary calculator ----------------------------//
 Route::group(['namespace' => 'Admin'], function () {
    Route::middleware(['admin'])
        ->get('/calculator/analytics', [SalaryCalculatorController::class,'index'])
        ->name('admin.calculator.index');  
});
//-------------------- End of salry calculator --------------------//

    // -------------------- Start routes for module Setting --------------------- //
    Route::group(['prefix'=>'setting', 'namespace'=>'Setting'], function () {
        Route::get('/languages/list', 'LanguageController@index');
        Route::get('/languages/api-list', 'LanguageController@index_api');
        Route::get('/languages/create', 'LanguageController@create');
        Route::post('/languages/store', 'LanguageController@store');
        Route::get('/languages/show/{id}/{sub_page?}', 'LanguageController@show');
        Route::get('/languages/edit/{id}', 'LanguageController@edit');
        Route::post('/languages/update/{id}', 'LanguageController@update');
        Route::get('/languages/delete/{id}', 'LanguageController@destroy');//
        Route::post('/languages/update-translation', 'LanguageController@update_translation');//
        
        Route::middleware(['admin'])->get('/locations/list', 'LocationController@index'); // Retrieve list of Locations
        Route::middleware(['admin'])->get('/locations/api-list', 'LocationController@index_api'); // Retrieve list of json Locations 
        Route::middleware(['admin'])->get('/locations/create', 'LocationController@create'); // Display form TO add Location
        Route::middleware(['admin'])->post('/locations/store', 'LocationController@store'); // Save new Location
        Route::middleware(['admin'])->get('/locations/show/{id}/{sub_page?}', 'LocationController@show'); // Retrieve specific Location data by ID
        Route::middleware(['admin'])->get('/locations/edit/{id}', 'LocationController@edit'); // Retrieve edit form for specific Location
        Route::middleware(['admin'])->post('/locations/update/{id}', 'LocationController@update'); // Update specific Location data by ID
        Route::middleware(['admin'])->get('/locations/delete/{id}', 'LocationController@destroy'); // Delete specific Location by ID
        
        
        Route::middleware(['admin'])->get('/tags/list', 'TagController@index'); // Retrieve list of Tags
        Route::middleware(['admin'])->get('/tags/api-list', 'TagController@index_api'); // Retrieve list of json Tags 
        Route::middleware(['admin'])->get('/tags/create', 'TagController@create'); // Display form TO add Tag
        Route::middleware(['admin'])->post('/tags/store', 'TagController@store'); // Save new Tag
        Route::middleware(['admin'])->get('/tags/show/{id}/{sub_page?}', 'TagController@show'); // Retrieve specific Tag data by ID
        Route::middleware(['admin'])->get('/tags/edit/{id}', 'TagController@edit'); // Retrieve edit form for specific Tag
        Route::middleware(['admin'])->post('/tags/update/{id}', 'TagController@update'); // Update specific Tag data by ID
        Route::middleware(['admin'])->get('/tags/delete/{id}', 'TagController@destroy'); // Delete specific Tag by ID
        
    });
    // -------------------- End routes invoive Setting --------------------- //

    
});