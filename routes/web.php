<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\ArtNewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\OprecController;
use App\Http\Controllers\SearchController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/tentang', [PageController::class, 'about'])->name('about');

Route::get('/karya', [ArtworkController::class, 'index'])->name('artworks.index');
Route::get('/karya/{slug}', [ArtworkController::class, 'show'])->name('artworks.show');

Route::get('/budaya', [CultureController::class, 'index'])->name('cultures.index');
Route::get('/budaya/{slug}', [CultureController::class, 'show'])->name('cultures.show');

Route::get('/seni', [ArtNewsController::class, 'index'])->name('arts.index');
Route::get('/seni/{slug}', [ArtNewsController::class, 'show'])->name('arts.show');

Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/arsip', [ArchiveController::class, 'index'])->name('archives.index');

Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::post('/kontak', [PageController::class, 'sendMessage'])->name('contact.send')->middleware('throttle:5,1');

Route::get('/oprec', [OprecController::class, 'index'])->name('oprec.index');
Route::post('/oprec', [OprecController::class, 'store'])->name('oprec.store')->middleware('throttle:5,1');
