<?php

    use App\Http\Controllers\CompanyController;
    use App\Http\Controllers\Hr\HomePageController;

    use App\Http\Controllers\Hr\PostController;
    use App\Http\Controllers\Hr\PostManager;

    Route::get('/', [HomePageController::class, 'index'] )->name('index');

//    Route::get('/{post}', [HomePageController::class, 'show'])->name('show');

    Route::get('/post_manager', [PostManager::class, 'index'] )->name('post_manager');

    Route::group([
        'as' => 'posts.',
        'prefix' => 'posts/',
    ], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::post('/import-csv', [PostController::class, 'importCSV'])->name('import_csv');

    });

    Route::group([
        'as' => 'companies.',
        'prefix' => 'companies/',
    ], function () {
        Route::post('/store', [CompanyController::class, 'store'])->name('store');
    });

