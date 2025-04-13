<?php

use App\Livewire\GestionClientes;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/clientes', GestionClientes::class)->name('clientes');
Route::get('/proveedores', GestionClientes::class)->name('proveedores');
