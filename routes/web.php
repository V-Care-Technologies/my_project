<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ToDoController;
use App\Http\Controllers\admin\FileManagerController;
use App\Http\Controllers\front\FrontController;


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


Route::get('/clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});

Route::get('/optimize', function () {
    \Artisan::call('optimize');
    return 'Optimization complete!';
});
Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });


Route::get('/',[FrontController::class,'index'])->name('front.index');
Route::get('/about',[FrontController::class,'about'])->name('front.about');
Route::get('/terms-conditions',[FrontController::class,'termsConditions'])->name('front.terms-conditions');
Route::get('/terms-of-sale',[FrontController::class,'termsSales'])->name('front.terms-of-sale');
Route::get('/privacy-policy',[FrontController::class,'privacyPolicy'])->name('front.privacy-policy');
Route::get('/security-policy',[FrontController::class,'securityPolicy'])->name('front.security-policy');
Route::get('/return-policy',[FrontController::class,'returnPolicy'])->name('front.return-policy');
Route::get('/contact-us',[FrontController::class,'contact'])->name('front.contact-us');
Route::post('sendcontact',[FrontController::class,'sendcontact']);

Route::match(['get', 'post'], 'product/changeproductimage', [FrontController::class, 'changeproductimage']);

Route::get('login-register',[FrontController::class,'loginRegister'])->name('front.loginRegister');
Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontController::class,'login_process'])->name('login.login_process');
Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('search/{str}',[FrontController::class,'search']);
Route::get('category/{id}',[FrontController::class,'category']);
Route::get('cart',[FrontController::class,'cart']);

 Route::group(['middleware'=>'prevent-back-history'],function(){
        Route::get('/checkout',[FrontController::class,'checkout']);
   });

Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);
Route::post('place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'order_placed']);
Route::get('/order_fail',[FrontController::class,'order_fail']);
Route::get('/paymentCallback',[FrontController::class,'paymentCallback'])->name('paymentCallback');

Route::get('product/{id}',[FrontController::class,'product']);
Route::post('add_to_wishlist',[FrontController::class,'add_to_wishlist']);
Route::get('wishlist',[FrontController::class,'wishList']);

Route::post('/get-price-data',[FrontController::class,'getPriceData'])->name('get-price-data');

 Route::get('search',[FrontController::class,'search'])->name('front.search');
  Route::get('searchh/{id}',[FrontController::class,'search'])->name('searchh');

 Route::post('subscribe',[FrontController::class,'subscribe']);

Route::get('blog/{alias}',[FrontController::class,'blog']);
Route::get('category/{id}',[FrontController::class,'category'])->name('category');

Route::group(['middleware'=>'user_auth'],function(){
    Route::get('/order',[FrontController::class,'order']);
    Route::get('/order_pdf/{id}',[FrontController::class,'order_pdf']);
    Route::get('/order_return/{id}',[FrontController::class,'order_return']);
    Route::post('sentreturn',[FrontController::class,'sentreturn'])->name('front.sentreturn');
    Route::get('/order_detail/{id}',[FrontController::class,'order_detail']);
    Route::get('/my-account',[FrontController::class,'my_account'])->name('front.my_account');
    Route::post('/my-account/update',[FrontController::class,'myAccountUpdate'])->name('front.my_account.update');

});

Route::get('logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
});

Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware' => 'prevent-back-history'],function(){
Route::group(['middleware'=>'admin_auth'],function(){

    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');



    Route::get('admin/customer',[UserController::class,'index'])->name('admin.customer');
    Route::get('admin/customer/show/{id}',[UserController::class,'show']);
    Route::get('admin/customer/manage-customer',[UserController::class,'manage_customer'])->name('admin.manage.customer');
    Route::get('admin/customer/manage-customer/{id}',[UserController::class,'manage_customer']);
    Route::post('admin/customer/manage-customer-process',[UserController::class,'manage_customer_process'])->name('customer.manage-customer-process');
    Route::get('admin/customer/status/{status}/{id}',[UserController::class,'status']);
    Route::post('admin/customer/delete',[UserController::class,'delete']);

    Route::get('admin/project',[ProjectController::class,'index'])->name('admin.project');
    Route::get('admin/project/manage-project',[ProjectController::class,'manage_project'])->name('admin.manage.project');
    Route::get('admin/project/manage-project/{id}',[ProjectController::class,'manage_project']);
    Route::post('admin/project/manage-project-process',[ProjectController::class,'manage_project_process'])->name('project.manage-project-process');
    Route::post('admin/project/delete',[ProjectController::class,'delete']);

    Route::get('admin/todo',[ToDoController::class,'index'])->name('admin.todo');
    Route::get('admin/project/todo',[ToDoController::class,'project_todo'])->name('admin.project.todo');
    Route::get('admin/todo/manage-todo',[ToDoController::class,'manage_todo'])->name('admin.manage.todo');
    Route::get('admin/todo/manage-todo/{id}',[ToDoController::class,'manage_todo']);
    Route::post('admin/todo/manage-todo-process',[ToDoController::class,'manage_todo_process'])->name('todo.manage-todo-process');
    Route::post('admin/todo/delete',[ToDoController::class,'delete']);

    Route::get('filemanager', [FileManagerController::class, 'index'])->name('admin.filemanager');




   Route::get('admin/settings',[SettingsController::class,'index'])->name('admin.settings');
    Route::post('admin/settings/manage-settings-process',[SettingsController::class,'manage_settings_process'])->name('settings.manage-settings-process');

    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');

        return redirect('admin')->with('message','Logout Successfully');
    });

});
});
