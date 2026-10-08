<?php

use App\Http\Controllers\Api\V1\EducationController;
use App\Http\Controllers\Api\V1\ExperienceController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Portfolio Public API v1
|--------------------------------------------------------------------------
|
| Read-only, rate-limited JSON endpoints exposing the same data that
| powers the server-rendered portfolio. Intended for recruiters,
| integrations, and technical review of API design.
|
*/

Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('api.v1.profile');
    Route::get('/projects', [ProjectController::class, 'index'])->name('api.v1.projects.index');
    Route::get('/projects/{idOrSlug}', [ProjectController::class, 'show'])->name('api.v1.projects.show');
    Route::get('/skills', [SkillController::class, 'index'])->name('api.v1.skills.index');
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('api.v1.experiences.index');
    Route::get('/education', [EducationController::class, 'index'])->name('api.v1.education.index');
});
