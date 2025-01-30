<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::middleware('guest')->group(function () {
            Route::get('/', function () {
                return view('welcome');
            })->name('guest_welcome');

            Route::fallback(function(){
                return redirect()->route('welcome');
            });
        });

        Route::prefix('/user')->middleware(['auth','user'])->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('welcome');
            // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            Route::fallback(function(){
                return redirect()->route('welcome');
            });
        });


        Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');

            // start routes for category crud
            Route::get('/categories', [CategorieController::class, 'all_categories'])->name('all_categories');
            Route::get('/category/add', [CategorieController::class, 'category_form_add'])->name('category_form_add');
            Route::post('/category/add', [CategorieController::class, 'add_category'])->name('add_category');
            Route::post('/category/update', [CategorieController::class, 'category_form_update'])->name('category_form_update');
            Route::patch('/category/update', [CategorieController::class, 'update'])->name('update_category');
            Route::delete('/category/delete', [CategorieController::class, 'destroy'])->name('destroy_category');
            // end routes for category crud


            // Books CRUD
            Route::get('/books', [LivreController::class, 'all_books'])->name('all_books');
            Route::get('/book/add', [LivreController::class, 'book_form_add'])->name('book_form_add');
            Route::post('/book/add', [LivreController::class, 'add_book'])->name('add_book');
            Route::post('/book/update-form', [LivreController::class, 'book_form_update'])->name('book_form_update'); // Use POST for update form
            Route::patch('/book/update', [LivreController::class, 'update'])->name('update_book'); // Use PATCH for update action
            Route::delete('/book/delete', [LivreController::class, 'destroy'])->name('destroy_book'); // Use DELETE for delete action

            // Reservations CRUD
            Route::get('/reservations', [ReservationController::class, 'all_reservations'])->name('all_reservations');
            Route::get('/reservation/add', [ReservationController::class, 'reservation_form_add'])->name('reservation_form_add');
            Route::post('/reservation/add', [ReservationController::class, 'add_reservation'])->name('add_reservation');
            Route::post('/reservation/update-form', [ReservationController::class, 'reservation_form_update'])->name('reservation_form_update'); // Use POST for update form
            Route::patch('/reservation/update', [ReservationController::class, 'update'])->name('update_reservation'); // Use PATCH for update action
            Route::delete('/reservation/delete', [ReservationController::class, 'destroy'])->name('destroy_reservation'); // Use DELETE for delete action
                        // start routes for users crud
            // Users CRUD
            Route::get('/users', [UserController::class, 'all_users'])->name('all_users');
            Route::get('/user/add', [UserController::class, 'user_form_add'])->name('user_form_add');
            Route::post('/user/add', [UserController::class, 'add_user'])->name('add_user');
            Route::post('/user/update-form', [UserController::class, 'user_form_update'])->name('user_form_update'); // Use POST for update form
            Route::patch('/user/update', [UserController::class, 'update'])->name('update_user'); // Use PATCH for update action
            Route::delete('/user/delete', [UserController::class, 'destroy'])->name('destroy_user'); // Use DELETE for delete action


            Route::fallback(function(){
                return redirect()->route('admin_dashboard');
            });
        });



        require __DIR__.'/auth.php';
    });
