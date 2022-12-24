<?php


    use App\Http\Controllers\Applicant\ApplicantController;
    use App\Http\Controllers\HomePage\HomePageController;
    use Illuminate\Support\Facades\Route;


    Route::get('/', [ApplicantController::class, 'index'] )->name('index');
//
////    Route::get('/applicant', [HomePageController::class, 'index'])->name('index');
    Route::get('/{post}', [ApplicantController::class, 'show'])->name('show');
