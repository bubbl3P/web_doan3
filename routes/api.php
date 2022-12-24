<?php

    use App\Http\Controllers\CompanyController;
    use App\Http\Controllers\HrPostController;
    use App\Http\Controllers\LanguageController;
    use App\Http\Controllers\PostController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts-hr', [HrPostController::class, 'index'])->name('posts-hr');
    Route::post('/posts/slug', [PostController::class, 'generateSlug'])->name('posts.slug.generate');
    Route::get('/posts/slug', [PostController::class, 'checkSlug'])->name('posts.slug.check');
    Route::get('/companies/check/{companyName?}', [CompanyController::class, 'check'])->name('companies.check');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
