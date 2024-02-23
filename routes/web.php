<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Fronted\FrontedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// frontend 
Route::get('/config-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "<h1>Cache Cleared!</h1>";
});
Route::get('/db-seed', function () {
    // Artisan::call('db:seed');
    Artisan::call('migrate');

    return "<h1>Success!</h1>";
});

// All blog page/Fronted link routes

    Route::group(['middleware' => 'lang'], static function(){

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/', [FrontedController::class, 'index'])->name('front.index');
    Route::get('/all-post', [FrontedController::class, 'all_post'])->name('front.all_post');
    Route::get('/search', [FrontedController::class, 'search'])->name('front.search');
    Route::get('/category/{slug}', [FrontedController::class, 'category'])->name('front.category');
    Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontedController::class, 'sub_category'])->name('front.sub_category');
    Route::get('/tag/{slug}', [FrontedController::class, 'tag'])->name('front.tag');
    Route::get('/single-post/{slug}', [FrontedController::class, 'single'])->name('front.single');
    Route::get('contact', [FrontedController::class, 'contact'])->name('front.contact');
    Route::post('contact', [FrontedController::class, 'contactstore'])->name('contact.store');
 // Get profile district address
    Route::get('get-districts/{division_id}', [UserProfileController::class, 'getDistrict']);
    Route::get('get-thanas/{district_id}', [UserProfileController::class, 'getThana']);
    Route::get('post-count/{post_id}', [FrontedController::class, 'postReadCount']);
    Route::get('switch-language', [FrontedController::class, 'switch_language'])->name('switch.language');
    
    Route::post('category/status/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::post('sub-category/status/{id}', [SubCategoryController::class, 'status'])->name('sub-category.status');
    Route::post('tag/status/{id}', [TagController::class, 'status'])->name('tag.status');
    Route::post('tagstore/tagstore/{id}', [PostController::class, 'TagStore'])->name('tagstore.com');
    Route::post('post/status/{id}', [PostController::class, 'status'])->name('post.status');
    // Route::post('add-comment', [CommentController::class, 'store'])->name('comment.store');

    // Profile password change routes
    Route::get('/password/change', [HomeController::class, 'passwordChange'])->name('use.password.change');
    Route::post('/password/update', [HomeController::class, 'passwordUpdate'])->name('use.password.update');

     //user support ticket
     Route::group(['prefix' => 'user'], function(){
         Route::get('/open/ticket',[TicketController::class, 'OpenTicket'])->name('open.ticket');
         Route::get('/new/ticket',[TicketController::class, 'NewTicket'])->name('new.ticket');
         Route::post('/store/ticket',[TicketController::class, 'StoreTicket'])->name('store.ticket');
         Route::get('/show/ticket/{id}',[TicketController::class, 'ShowTicket'])->name('show.ticket');

         Route::post('/reply/ticket',[TicketController::class, 'ReplyTicket'])->name('reply.ticket');
     });

     //user profile status
     Route::group(['prefix'=>'user-profile'], function (){
        Route::get('/', [UserProfileController::class, 'userindex'])->name('user.profile.index');
        Route::post('//update', [UserProfileController::class, 'userupdate'])->name('user.profile.update');
     });

     Route::group(['prefix'=>'seo'], function () {
        Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
        Route::post('/update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
    });
    
    
    // Admin page routes

    Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function (){
             //admin profile status
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/password/change', [DashboardController::class, 'passwordChange'])->name('admin.password.change');
        Route::post('/password/update', [DashboardController::class, 'passwordUpdate'])->name('admin.password.update');
   
        Route::post('upload-photo', [UserProfileController::class, 'upload_photo'])->name('user.upload_photo');
        Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
        // Route::resource('post', PostController::class);
        Route::resource('comment', CommentController::class);
        Route::resource('profile', UserProfileController::class);

        Route::group(['prefix'=>'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::get('/create', [PostController::class, 'create'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->name('post.store');
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
            Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
            Route::get('/show/{post}', [PostController::class, 'show'])->name('post.show');
            Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
        });
    
        Route::group(['middleware'=> 'admin'], static function(){
        // Route::resource('category', CategoryController::class);
        Route::group(['prefix'=>'category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/show/{id}', [CategoryController::class, 'show'])->name('category.show');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });
        Route::group(['prefix'=>'sub-category'], function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('sub-category.index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
            Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
            Route::get('/show/{id}', [SubCategoryController::class, 'show'])->name('sub-category.show');
            Route::get('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');
        });
    
        Route::group(['prefix'=>'tag'], function () {
            Route::get('/', [TagController::class, 'index'])->name('tag.index');
            Route::get('/create', [TagController::class, 'create'])->name('tag.create');
            Route::post('/store', [TagController::class, 'store'])->name('tag.store');
            Route::get('/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
            Route::post('/update', [TagController::class, 'update'])->name('tag.update');
            Route::get('/show/{post}', [TagController::class, 'show'])->name('tag.show');
            Route::get('/delete/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
        });

         //website setting routes
         Route::group(['prefix'=>'website'], function () {
            Route::get('/', [SettingController::class, 'website'])->name('website.setting');
            Route::post('/update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.setting.update');
        });
          //ticket routes
          Route::group(['prefix'=>'ticket'], function () {
            Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
            Route::get('/show/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
            Route::post('/reply/store', [TicketController::class, 'AdminReplystore'])->name('admin.store.reply');
            Route::get('/close/{id}', [TicketController::class, 'TicketClose'])->name('admin.close.ticket');
            Route::delete('/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.delete');
        });

          //Contact route
        Route::group(['prefix'=>'contact'], function(){
            Route::get('/',[ContactController::class, 'index'])->name('admin.contact.index');
            Route::post('/reply/contact',[ContactController::class, 'ReplyContact'])->name('admin.contact.reply');
            Route::get('/show/{id}',[ContactController::class, 'show'])->name('admin.contact.show');
            Route::get('/delete/{id}',[ContactController::class, 'destroy'])->name('contact.delete');
        });

        
        
    });
    
    });
    
    
    // Route::get('/dashboard', function ()
    // {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
    
    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });
    
    require __DIR__.'/auth.php';
});








