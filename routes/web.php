<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DisclosureController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Loads the SK Landing Page you built
Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing');
Route::get('/all-projects', [App\Http\Controllers\LandingPageController::class, 'projects'])->name('projects.all');
Route::post('/suggestions', [App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestions.store');
/*
|--------------------------------------------------------------------------
| SK Kabataan (Youth) Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dynamic dashboard passing the SK ID application status
    Route::get('/dashboard', function () {
        // Fetch the user's latest ID request
        $skId = \App\Models\SkIdRequest::where('user_id', auth()->id())->latest()->first();
        return view('dashboard', compact('skId'));
    })->name('dashboard');

    // SK ID Routes
    Route::post('/sk-id/submit', [App\Http\Controllers\User\SkIdController::class, 'store'])->name('sk_id.store');
    Route::post('/sk-id/replace', [App\Http\Controllers\User\SkIdController::class, 'requestReplacement'])->name('sk_id.replace');

    Route::post('/sk-id/submit', [App\Http\Controllers\User\SkIdController::class, 'store'])->name('sk_id.store');
Route::put('/sk-id/update', [App\Http\Controllers\User\SkIdController::class, 'update'])->name('sk_id.update'); // NEW
Route::post('/sk-id/replace', [App\Http\Controllers\User\SkIdController::class, 'requestReplacement'])->name('sk_id.replace');

    // Profile management (Provided by Laravel Breeze)
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| SK Admin Routes
|--------------------------------------------------------------------------
*/

// Protected by standard auth AND your custom 'admin' middleware
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard: Access via /admin/dashboard
  Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Public Disclosure Management Routes
    Route::get('/disclosure', [DisclosureController::class, 'index'])->name('disclosure.index');
    Route::post('/disclosure', [DisclosureController::class, 'store'])->name('disclosure.store');
    // Add these two new lines:
    Route::get('/disclosure/{disclosure}/edit', [DisclosureController::class, 'edit'])->name('disclosure.edit');
    Route::put('/disclosure/{disclosure}', [DisclosureController::class, 'update'])->name('disclosure.update');
    Route::delete('/disclosure/{disclosure}', [DisclosureController::class, 'destroy'])->name('disclosure.destroy');

    // Book Categories Management
Route::get('/categories', [App\Http\Controllers\Admin\DisclosureCategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [App\Http\Controllers\Admin\DisclosureCategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\DisclosureCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [App\Http\Controllers\Admin\DisclosureCategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [App\Http\Controllers\Admin\DisclosureCategoryController::class, 'destroy'])->name('categories.destroy');

// Projects & Events Management
Route::get('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/admin/youth-registry', [\App\Http\Controllers\Admin\YouthRegistryController::class, 'index'])->name('youth_registry');
Route::get('/admin/suggestions', [App\Http\Controllers\SuggestionController::class, 'index'])->name('suggestions');
//sk id
Route::get('/sk-ids', [App\Http\Controllers\Admin\SkIdAdminController::class, 'index'])->name('sk_ids.index');
    Route::put('/sk-ids/{skIdRequest}/status', [App\Http\Controllers\Admin\SkIdAdminController::class, 'updateStatus'])->name('sk_ids.update_status');
});

// Loads all authentication routes (login, register, reset password)
require __DIR__.'/auth.php';
