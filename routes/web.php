<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ScreenshotController;

/* =====================
   FRONTEND PUBLIC ROUTES
   ===================== */

// Homepage
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// About
Route::get('/about', [FrontendController::class, 'about'])->name('about');

// Services
Route::get('/services', [FrontendController::class, 'services'])->name('services');

// Contact page (GET) + form submission (POST → stores to ContactInquiry DB)
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'contact'])->name('contact.submit');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Blog post detail (used in blog card Read More link)
Route::get('/blog/{slug}', function($slug) {
    // TODO: implement BlogPostController@show when blog is ready
    abort(404);
})->name('blog.show');

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

        // Dashboard
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

        // Products + Screenshots
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::resource('products', ProductController::class)->except(['show']);
        Route::post('products/{product}/screenshots', [ProductController::class, 'addScreenshot'])->name('products.screenshots.store');
        Route::delete('product-screenshots/{screenshot}', [ProductController::class, 'deleteScreenshot'])->name('product-screenshots.destroy');

        // Projects + Screenshots
        Route::get('projects/export', [ProjectController::class, 'export'])->name('projects.export');
        Route::post('projects/import', [ProjectController::class, 'import'])->name('projects.import');
        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::post('projects/{project}/screenshots', [ProjectController::class, 'addScreenshot'])->name('projects.screenshots.store');
        Route::delete('project-screenshots/{screenshot}', [ProjectController::class, 'deleteScreenshot'])->name('project-screenshots.destroy');

        // Screenshots Gallery
        Route::get('screenshots/export', [ScreenshotController::class, 'export'])->name('screenshots.export');
        Route::post('screenshots/import', [ScreenshotController::class, 'import'])->name('screenshots.import');
        Route::get('screenshots', [ScreenshotController::class, 'index'])->name('screenshots.index');
        Route::post('screenshots', [ScreenshotController::class, 'store'])->name('screenshots.store');

        // Testimonials
        Route::get('testimonials/export', [TestimonialController::class, 'export'])->name('testimonials.export');
        Route::post('testimonials/import', [TestimonialController::class, 'import'])->name('testimonials.import');
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        // Pricing Plans
        Route::resource('pricing-plans', PricingPlanController::class)->except(['show']);

        // Blog Posts
        Route::get('blog-posts/export', [BlogPostController::class, 'export'])->name('blog-posts.export');
        Route::post('blog-posts/import', [BlogPostController::class, 'import'])->name('blog-posts.import');
        Route::resource('blog-posts', BlogPostController::class)->except(['show']);

        // Contact Inquiries (readonly + status update + delete)
        Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::get('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'show'])->name('contact-inquiries.show');
        Route::patch('contact-inquiries/{contactInquiry}/status', [ContactInquiryController::class, 'updateStatus'])->name('contact-inquiries.status');
        Route::delete('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');

        // Tech Stacks
        Route::get('tech-stacks/export', [TechStackController::class, 'export'])->name('tech-stacks.export');
        Route::post('tech-stacks/import', [TechStackController::class, 'import'])->name('tech-stacks.import');
        Route::resource('tech-stacks', TechStackController::class)->except(['show']);

        // Stats
        Route::resource('stats', StatController::class)->except(['show']);

        // FAQs
        Route::resource('faqs', FaqController::class)->except(['show']);
    });
});
