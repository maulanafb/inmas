<?php

use App\Http\Controllers\User\ClassController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LearningModuleController;
use App\Http\Controllers\User\ProfileController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    // return redirect()->route('login');
})->middleware(['auth', 'verified', 'checkRole'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

});

Route::prefix('courses/{course}/contents')->group(function () {
    Route::get('/', [CourseContentController::class, 'index'])->name('courses.contents.index');
    Route::get('/create', [CourseContentController::class, 'create'])->name('courses.contents.create');
    Route::post('/', [CourseContentController::class, 'store'])->name('courses.contents.store');
    Route::get('/{content}/edit', [CourseContentController::class, 'edit'])->name('courses.contents.edit');
    Route::put('/{content}', [CourseContentController::class, 'update'])->name('courses.contents.update');
    Route::delete('/{content}', [CourseContentController::class, 'destroy'])->name('courses.contents.destroy');
});

Route::resource('courses.course_contents', CourseContentController::class);



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::post('learning-modules/{course_id}', [LearningModuleController::class, 'store'])->name('learning-modules.store');
    Route::put('learning-modules/{learningModule_id}', [LearningModuleController::class, 'update'])->name('learning-modules.update');
    Route::delete('learning-modules/{learningModule_id}', [LearningModuleController::class, 'destroy'])->name('learning-modules.destroy');

    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('courses', CourseController::class);
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');


    // class route
    Route::get('class', [ClassController::class, 'index'])->name('admin.class.index');
});



Route::prefix('/user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/class/{contentId}', [ClassController::class, 'index'])->name('user.class.index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/class/{class}', [ClassController::class, 'index'])->name('user.class.show');
});



require __DIR__ . '/auth.php';
