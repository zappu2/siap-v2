<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelatihanWebinarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/webinar/download-sertifikat/{id}', [PelatihanWebinarController::class, 'downloadSertifikat'])
    ->name('webinar.download-sertifikat');
