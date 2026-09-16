<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ScreenshotController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/* =====================
   FRONTEND PUBLIC ROUTES (AmanOS)
   ===================== */

// Public OS Desktop Homepage
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Contact Form submission (POST -> stores to ContactInquiry DB)
Route::post('/contact', [WelcomeController::class, 'contact'])->name('contact.submit');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/* =====================
   ADMIN — GUEST ROUTES
   ===================== */
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (Guest only)
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'showLogin'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        Route::get('forgot-password', [LoginController::class, 'showForgotPassword'])->name('forgot-password');
        Route::post('forgot-password', [LoginController::class, 'sendResetLink'])->name('forgot-password.post');
    });

    /* =====================
       ADMIN — AUTH REQUIRED
       ===================== */
    Route::middleware('auth')->group(function () {

        // Logout
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Admin OS Desktop Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.alt');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        // Services
        Route::get('services/export', [ServiceController::class, 'export'])->name('services.export');
        Route::post('services/import', [ServiceController::class, 'import'])->name('services.import');
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::post('services/{id}/restore', [ServiceController::class, 'restore'])->name('services.restore');

        // Products / Portfolio + Screenshots
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::resource('products', ProductController::class)->except(['show']);
        Route::post('products/{product}/screenshots', [ProductController::class, 'addScreenshot'])->name('products.screenshots.store');
        Route::delete('product-screenshots/{screenshot}', [ProductController::class, 'deleteScreenshot'])->name('product-screenshots.destroy');

        // Screenshots Gallery
        Route::get('screenshots/export', [ScreenshotController::class, 'export'])->name('screenshots.export');
        Route::post('screenshots/import', [ScreenshotController::class, 'import'])->name('screenshots.import');
        Route::get('screenshots', [ScreenshotController::class, 'index'])->name('screenshots.index');
        Route::post('screenshots', [ScreenshotController::class, 'store'])->name('screenshots.store');

        // Blog Posts
        Route::get('blog-posts/export', [BlogPostController::class, 'export'])->name('blog-posts.export');
        Route::post('blog-posts/import', [BlogPostController::class, 'import'])->name('blog-posts.import');
        Route::resource('blog-posts', BlogPostController::class)->except(['show']);

        // Contact Inquiries (readonly + status update + delete)
        Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::get('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'show'])->name('contact-inquiries.show');
        Route::patch('contact-inquiries/{contactInquiry}/status', [ContactInquiryController::class, 'updateStatus'])->name('contact-inquiries.status');
        Route::delete('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');
    });
});
