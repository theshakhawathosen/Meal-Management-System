<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('auth/google/callback', [HomeController::class, 'callback'])->name('callback');
Route::fallback(function(){
    return redirect()->route('homepage');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/update-profile', [UserController::class, 'Updateprofile'])->name('user.Updateprofile');
    Route::post('/show-report', [UserController::class, 'showreport'])->name('user.showreport');


    // My Depostie
    Route::get('/my-deposite', [UserController::class, 'mydeposite'])->name('user.mydeposite');
    Route::get('/pending-deposite', [UserController::class, 'pendingdeposite'])->name('user.pendingdeposite');
    Route::post('/delete-deposite', [AdminController::class, 'deleteDeposite'])->name('user.deleteDeposite');
    Route::get('/request-deposite', [UserController::class, 'requestdeposite'])->name('user.requestdeposite');
    Route::post('/store-deposite', [UserController::class, 'storedeposite'])->name('user.storedeposite');

    // My Meal
    Route::get('/my-meal', [UserController::class, 'mymeal'])->name('user.mymeal');
    Route::get('/pending-meal', [UserController::class, 'pendingmeal'])->name('user.pendingmeal');
    Route::post('/delete-meal', [AdminController::class, 'deletemeal'])->name('user.deletemeal');
    Route::get('/request-meal', [UserController::class, 'requestmeal'])->name('user.requestmeal');
    Route::post('/store-meal', [UserController::class, 'storemeal'])->name('user.storemeal');

    // Cost History
    Route::get('/my-cost', [UserController::class, 'mycost'])->name('user.mycost');


    // Bazar
    Route::get('/my-bazar', [UserController::class, 'mybazar'])->name('user.mybazar');
    Route::get('/pending-bazar', [UserController::class, 'pendingbazar'])->name('user.pendingbazar');
    Route::post('/delete-bazar', [AdminController::class, 'deletebazar'])->name('user.deletebazar');
    Route::get('/request-bazar', [UserController::class, 'requestbazar'])->name('user.requestbazar');
    Route::post('/store-bazar', [UserController::class, 'storebazar'])->name('user.storebazar');

    // Notification
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
    Route::get('/read-and-redirect/{id}/{redirect}', [UserController::class, 'readandredirect'])->name('user.readandredirect');
    Route::post('/delete-notification', [UserController::class, 'deletenotification'])->name('user.deletenotification');
    Route::get('/read-notification/{id}', [UserController::class, 'readnotification'])->name('user.readnotification');
    Route::get('/unread-notification/{id}', [UserController::class, 'unreadnotification'])->name('user.unreadnotification');
    Route::post('/delete-all-notification', [UserController::class, 'deleteallnotification'])->name('user.deleteallnotification');
    Route::post('/read-all-notification', [UserController::class, 'readallnotification'])->name('user.readallnotification');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/update-profile', [AdminController::class, 'Updateprofile'])->name('admin.Updateprofile');

    // Deposite
    Route::get('/deposite', [AdminController::class, 'deposite'])->name('admin.deposite');
    Route::get('/create-deposite', [AdminController::class, 'Createdeposite'])->name('admin.Createdeposite');
    Route::post('/store-deposite', [AdminController::class, 'Storedeposite'])->name('admin.Storedeposite');
    Route::post('/delete-deposite', [AdminController::class, 'deleteDeposite'])->name('admin.deleteDeposite');
    Route::get('/pending-deposite', [AdminController::class, 'pendingdeposite'])->name('admin.pendingDeposite');
    Route::post('/accept-deposite', [AdminController::class, 'acceptDeposite'])->name('admin.acceptDeposite');
    Route::get('/export-deposite', [AdminController::class, 'exportDeposite'])->name('admin.exportDeposite');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/add-user', [AdminController::class, 'adduser'])->name('admin.adduser');
    Route::get('/pending-user', [AdminController::class, 'pendinguser'])->name('admin.pendingusers');
    Route::post('/delete-user', [AdminController::class, 'deleteuser'])->name('admin.deleteuser');
    Route::get('/create-user', [AdminController::class, 'adduser'])->name('admin.adduser');
    Route::post('/store-user', [AdminController::class, 'storeuser'])->name('admin.storeuser');
    Route::get('/export-users', [AdminController::class, 'exportusers'])->name('admin.exportusers');
    Route::post('/accept-user', [AdminController::class, 'acceptuser'])->name('admin.acceptuser');
    Route::get('/edit-user/{id}', [AdminController::class, 'edituser'])->name('admin.edituser');
    Route::post('/update-user', [AdminController::class, 'updateuser'])->name('admin.updateuser');


    // Change Manager
    Route::get('/change-manager', [AdminController::class, 'changemanager'])->name('admin.changemanager');
    Route::post('/update-manager', [AdminController::class, 'updatemanager'])->name('admin.updatemanager');


    // Meals
    Route::get('/meals', [AdminController::class, 'meals'])->name('admin.meals');
    Route::get('/add-meals', [AdminController::class, 'addmeal'])->name('admin.addmeal');
    Route::post('/delete-meals', [AdminController::class, 'deletemeal'])->name('admin.deletemeal');
    Route::post('/accept-meals', [AdminController::class, 'acceptmeal'])->name('admin.acceptmeal');
    Route::get('/pending-meals', [AdminController::class, 'pendingmeal'])->name('admin.pendingmeal');
    Route::post('/store-meals', [AdminController::class, 'storemeal'])->name('admin.storemeal');
    Route::get('/edit-meal/{id}', [AdminController::class, 'editmeal'])->name('admin.editmeal');
    Route::post('/update-meal', [AdminController::class, 'updatemeal'])->name('admin.updatemeal');

    // Costs
    Route::get('/individual-cost', [AdminController::class, 'individualcost'])->name('admin.individualcost');
    Route::get('/add-individual-cost', [AdminController::class, 'addindividualcost'])->name('admin.addindividualcost');
    Route::post('/store-individual-cost', [AdminController::class, 'storeindividualcost'])->name('admin.storeindividualcost');
    Route::post('/delete-cost', [AdminController::class, 'deletecost'])->name('admin.deletecost');
    Route::get('/edit-cost/{id}', [AdminController::class, 'editcost'])->name('admin.editcost');
    Route::post('/update-cost', [AdminController::class, 'updatecost'])->name('admin.updatecost');

    // Bazar
    Route::get('/bazar', [AdminController::class, 'bazar'])->name('admin.bazar');
    Route::get('/add-bazar', [AdminController::class, 'addbazar'])->name('admin.addbazar');
    Route::post('/store-bazar', [AdminController::class, 'storebazar'])->name('admin.storebazar');
    Route::post('/delete-bazar', [AdminController::class, 'deletebazar'])->name('admin.deletebazar');
    Route::get('/edit-bazar/{id}', [AdminController::class, 'editbazar'])->name('admin.editbazar');
    Route::post('/update-bazar', [AdminController::class, 'updatebazar'])->name('admin.updatebazar');
    Route::get('/pending-bazar', [AdminController::class, 'pendingbazar'])->name('admin.pendingbazar');
    Route::post('/accept-bazar', [AdminController::class, 'acceptbazar'])->name('admin.acceptbazar');


    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/reset-everything', [AdminController::class, 'everything'])->name('admin.everything');


    // Dashboard
    Route::post('/show-report', [AdminController::class, 'showreport'])->name('admin.showreport');


    // Notification
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/read-and-redirect/{id}/{redirect}', [AdminController::class, 'readandredirect'])->name('admin.readandredirect');
    Route::post('/delete-notification', [AdminController::class, 'deletenotification'])->name('admin.deletenotification');
    Route::get('/read-notification/{id}', [AdminController::class, 'readnotification'])->name('admin.readnotification');
    Route::get('/unread-notification/{id}', [AdminController::class, 'unreadnotification'])->name('admin.unreadnotification');
    Route::post('/delete-all-notification', [AdminController::class, 'deleteallnotification'])->name('admin.deleteallnotification');
    Route::post('/read-all-notification', [AdminController::class, 'readallnotification'])->name('admin.readallnotification');

    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
