<?php

use App\Livewire\GestionClientes;
use App\Livewire\GestionProveedores;
use App\Livewire\Compras;
use App\Livewire\CrearFactura;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/clientes', GestionClientes::class)->name('clientes');
Route::get('/proveedores', GestionProveedores::class)->name('proveedores');
Route::get('/compras', Compras::class)->name('compras');
Route::get('/compras/crearfactura/{tipo}', CrearFactura::class)->name('compras.crearfactura');
