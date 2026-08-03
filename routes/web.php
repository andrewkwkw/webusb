<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontEndController;

Route::get('/', [FrontEndController::class, 'home'])->name('home');
Route::get('/tentang', [FrontEndController::class, 'about'])->name('about');

Route::get('/karya', [FrontEndController::class, 'artworks'])->name('artworks.index');
Route::get('/karya/{slug}', [FrontEndController::class, 'showArtwork'])->name('artworks.show');

Route::get('/budaya', [FrontEndController::class, 'cultures'])->name('cultures.index');
Route::get('/budaya/{slug}', [FrontEndController::class, 'showCulture'])->name('cultures.show');

Route::get('/seni', [FrontEndController::class, 'arts'])->name('arts.index');
Route::get('/seni/{slug}', [FrontEndController::class, 'showArt'])->name('arts.show');

Route::get('/proyek', [FrontEndController::class, 'projects'])->name('projects.index');

Route::get('/arsip', [FrontEndController::class, 'archives'])->name('archives.index');

Route::get('/kontak', [FrontEndController::class, 'contact'])->name('contact');
Route::post('/kontak', [FrontEndController::class, 'sendMessage'])->name('contact.send')->middleware('throttle:5,1');

Route::get('/oprec', [FrontEndController::class, 'oprec'])->name('oprec.index');
Route::post('/oprec', [FrontEndController::class, 'storeOprec'])->name('oprec.store')->middleware('throttle:5,1');
