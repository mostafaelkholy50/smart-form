<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['ar', 'en'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('locale.switch');

// Admin routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Logo management
    Route::get('/logo', [AdminController::class, 'showLogoSettings'])->name('logo');
    Route::post('/logo', [AdminController::class, 'updateLogo'])->name('logo.update');

    // Header links management
    Route::get('/links', [AdminController::class, 'showLinksSettings'])->name('links');
    Route::post('/links', [AdminController::class, 'storeLink'])->name('links.store');
    Route::put('/links/{link}', [AdminController::class, 'updateLink'])->name('links.update');
    Route::delete('/links/{link}', [AdminController::class, 'deleteLink'])->name('links.delete');

    // Social Links Settings
    Route::get('/social', [AdminController::class, 'showSocialSettings'])->name('social');
    Route::post('/social', [AdminController::class, 'storeSocialLink'])->name('social.store');
    Route::put('/social/{link}', [AdminController::class, 'updateSocialLink'])->name('social.update');
    Route::delete('/social/{link}', [AdminController::class, 'deleteSocialLink'])->name('social.delete');

    // Slider Management
    Route::resource('slider', \App\Http\Controllers\AdminSliderController::class)->names([
        'index' => 'slider.index',
        'create' => 'slider.create',
        'store' => 'slider.store',
        'edit' => 'slider.edit',
        'update' => 'slider.update',
        'destroy' => 'slider.destroy',
    ]);

    // Services Management
    Route::resource('services', \App\Http\Controllers\AdminServiceController::class)->names([
        'index' => 'services.index',
        'create' => 'services.create',
        'store' => 'services.store',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy',
    ]);

    // Hosting Plans Management
    Route::resource('hosting_plans', \App\Http\Controllers\AdminHostingPlanController::class)->only(['index', 'edit', 'update'])->names([
        'index' => 'hosting_plans.index',
        'edit' => 'hosting_plans.edit',
        'update' => 'hosting_plans.update',
    ]);

    // Contact Methods Management
    Route::resource('contact', \App\Http\Controllers\AdminContactController::class)->except(['show'])->names([
        'index' => 'contact.index',
        'create' => 'contact.create',
        'store' => 'contact.store',
        'edit' => 'contact.edit',
        'update' => 'contact.update',
        'destroy' => 'contact.destroy',
    ]);

    // Pages Management
    Route::resource('pages', \App\Http\Controllers\AdminPageController::class)->names([
        'index' => 'pages.index',
        'create' => 'pages.create',
        'store' => 'pages.store',
        'edit' => 'pages.edit',
        'update' => 'pages.update',
        'destroy' => 'pages.destroy',
    ]);
});

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');
