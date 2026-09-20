<?php

use App\Http\Controllers\Admin\AtsGeneratorController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------
// Admin Route Registrar (handles subdomain `manage.` and `/manage`)
// -------------------------------------------------------------
$registerAdminRoutes = function (bool $named = true) {
    // Guest authentication routes
    $loginGet = Route::get('/login', [AuthController::class, 'showLogin']);
    $loginPost = Route::post('/login', [AuthController::class, 'login']);
    $logoutPost = Route::post('/logout', [AuthController::class, 'logout']);

    if ($named) {
        $loginGet->name('admin.login');
        $loginPost->name('admin.login.submit');
        $logoutPost->name('admin.logout');
    }

    // Authenticated admin workspace
    Route::middleware('auth')->group(function () use ($named) {
        $dashboard = Route::get('/', [DashboardController::class, 'index']);
        $profileEdit = Route::get('/profile', [AdminProfileController::class, 'edit']);
        $profileUpdate = Route::put('/profile', [AdminProfileController::class, 'update']);

        $projects = Route::resource('projects', ProjectController::class);
        $experiences = Route::resource('experiences', ExperienceController::class);
        $education = Route::resource('education', EducationController::class);
        $skills = Route::resource('skills', SkillController::class);

        $ats = Route::get('/ats-generator', [AtsGeneratorController::class, 'index']);
        $messagesIndex = Route::get('/messages', [MessageController::class, 'index']);
        $messagesShow = Route::get('/messages/{message}', [MessageController::class, 'show']);
        $messagesDestroy = Route::delete('/messages/{message}', [MessageController::class, 'destroy']);

        if ($named) {
            $dashboard->name('admin.dashboard');
            $profileEdit->name('admin.profile.edit');
            $profileUpdate->name('admin.profile.update');
            $projects->names('admin.projects');
            $experiences->names('admin.experiences');
            $education->names('admin.education');
            $skills->names('admin.skills');
            $ats->name('admin.ats.index');
            $messagesIndex->name('admin.messages.index');
            $messagesShow->name('admin.messages.show');
            $messagesDestroy->name('admin.messages.destroy');
        }
    });
};

$baseDomain = env('APP_DOMAIN', parse_url(config('app.url', 'http://localhost'), PHP_URL_HOST) ?: 'localhost');
$manageDomain = env('APP_MANAGE_DOMAIN', 'manage.' . $baseDomain);
$useSubdomain = (bool) env('APP_SUBDOMAIN_ADMIN', false);

if ($useSubdomain) {
    Route::domain($manageDomain)->group(fn () => $registerAdminRoutes(true));
    Route::prefix('manage')->group(fn () => $registerAdminRoutes(false));
} else {
    Route::prefix('manage')->group(fn () => $registerAdminRoutes(true));
    Route::domain($manageDomain)->group(fn () => $registerAdminRoutes(false));
}

// -------------------------------------------------------------
// Public Portfolio Routes
// -------------------------------------------------------------
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Language Switcher Route
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale.switch');
