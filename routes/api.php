<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;

Route::get('/applicants', [ApplicantController::class, 'index']);

Route::post('/applicants', [ApplicantController::class, 'store']);

Route::patch('/applicants/{id}/stage', [
    ApplicantController::class,
    'updateStage',
]);
