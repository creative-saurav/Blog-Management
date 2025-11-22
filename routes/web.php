<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth' , 'admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Blog Category
    Route::get('/admin/blog/category', [AdminController::class, 'blog_category'])->name('admin.blog.category');
    Route::get('/admin/blog/category/create', [AdminController::class, 'blog_category_create'])->name('admin.blog.category.create');
    Route::post('/admin/blog/category/store', [AdminController::class, 'blog_category_store'])->name('admin.blog.category.store');
    Route::get('/admin/blog/category/delete/{id}', [AdminController::class, 'blog_category_delete'])->name('admin.delete-blog-category');
    Route::get('/admin/blog/category/edit/{id}', [AdminController::class, 'blog_category_edit'])->name('admin.blog.category.edit');
    Route::post('/admin/blog/category/update/{id}', [AdminController::class, 'blog_category_update'])->name('admin.blog.category.update');

    //Admin Blog
    Route::get('/admin/blog', [AdminController::class, 'blog'])->name('admin.blog');
    Route::get('/admin/blog/create', [AdminController::class, 'blog_create'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [AdminController::class, 'blog_store'])->name('admin.blog.store');
    Route::get('/admin/blog/delete/{id}', [AdminController::class, 'blog_delete'])->name('admin.blog.delete');
    Route::get('/admin/blog/edit/{id}', [AdminController::class, 'blog_edit'])->name('admin.blog.edit');
    Route::post('/admin/blog/update/{id}', [AdminController::class, 'blog_update'])->name('admin.blog.update');

    // Settings
     Route::get('/admin/system_settings', [SettingsController::class, 'system_settings'])->name('admin.system_settings');
     Route::post('/admin/system_settings/update', [SettingsController::class, 'system_settings_update'])->name('admin.system_settings.update');
     Route::post('/admin/system_settings_social/update', [SettingsController::class, 'system_settings_social'])->name('admin.system_settings_social.update');

     Route::get('/admin/smtp', [SettingsController::class, 'system_smtp'])->name('admin.smtp');
     Route::post('/admin/smtp_settings/update', [SettingsController::class, 'smtp_settings_update'])->name('admin.smtp_settings.update');

    //  Subscription Package
    Route::get('/admin/subscription/package', [PackageController ::class, 'subscription_package'])->name('admin.subscription.package');
    Route::get('/admin/subscription/create', [PackageController::class, 'subscription_create'])->name('admin.subscription.create');
    Route::post('/admin/subscription/store', [PackageController::class, 'subscription_store'])->name('admin.subscription.store');
    Route::get('/admin/subscription/edit/{id}', [PackageController::class, 'subscription_edit'])->name('admin.subscription.edit');
    Route::post('/admin/subscription/update/{id}', [PackageController::class, 'subscription_update'])->name('admin.subscription.update');
    Route::get('/admin/subscription/delete/{id}', [PackageController::class, 'subscription_delete'])->name('admin.subscription.delete');

});
Route::middleware('auth' , 'user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
