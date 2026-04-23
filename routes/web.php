<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
