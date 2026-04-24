<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('skills');
Route::get('/statistics', [PortfolioController::class, 'statistics'])->name('statistics');
Route::post('/statistics/login', [PortfolioController::class, 'authenticateStatistics'])->name('statistics.login');
Route::post('/statistics/logout', [PortfolioController::class, 'logoutStatistics'])->name('statistics.logout');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
