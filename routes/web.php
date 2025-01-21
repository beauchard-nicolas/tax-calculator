<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxCalculatorController;

// Route principale - Affichage du calculateur
Route::get('/', [TaxCalculatorController::class, 'index'])->name('tax.index');

// Routes pour le calcul d'impôt
Route::get('/calculate', [TaxCalculatorController::class, 'index']); // Supprimé le name() ici
Route::post('/calculate', [TaxCalculatorController::class, 'calculate'])->name('tax.calculate');
