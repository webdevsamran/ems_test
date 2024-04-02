<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/download', function () {

    return view('download');
});
Route::get('/download_pdf', function () {
    $pdf = PDF::loadView('test');
    $filename = time() . '-generated.pdf';
    Storage::put('public/pdfs/' . $filename, $pdf->output());
    return $pdf->download($filename);
});
Route::get('/test', function () {
    return view('test');
});
