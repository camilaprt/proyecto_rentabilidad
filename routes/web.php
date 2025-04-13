<?php

use App\Livewire\GestionClientes;
use App\Livewire\GestionProveedores;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/clientes', GestionClientes::class)->name('clientes');
Route::get('/proveedores', GestionProveedores::class)->name('proveedores');
