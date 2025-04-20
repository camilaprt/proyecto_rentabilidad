<?php

use App\Livewire\GestionClientes;
use App\Livewire\GestionProveedores;
use App\Livewire\Compras;
use App\Livewire\CrearFactura;
use App\Livewire\CrearTicket;
use App\Livewire\Ventas;
use App\Livewire\Proyectos;
use App\Livewire\ProyectoDetalle;
use App\Livewire\DetalleCategoriaCompras;
use App\Livewire\DetalleCategoriaTickets;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/clientes', GestionClientes::class)->name('clientes');
Route::get('/proveedores', GestionProveedores::class)->name('proveedores');
Route::get('/compras', Compras::class)->name('compras');
Route::get('/compras/crearfactura/{tipo}', CrearFactura::class)->name('compras.crearfactura');
Route::get('/compras/{tipo}/editarfactura/{id}', CrearFactura::class)->name('compras.editarfactura');
Route::get('/compras/crearTickedt/', CrearTicket::class)->name('compras.crearticket');
Route::get('/compras/{tipo}/editarticket/{id}', CrearTicket::class)->name('compras.editarticket');
Route::get('/ventas', Ventas::class)->name('ventas');
Route::get('/ventas/crearfactura/{tipo}', CrearFactura::class)->name('ventas.crearfactura');
Route::get('/ventas/{tipo}/editarfactura/{id}', CrearFactura::class)->name('ventas.editarfactura');
Route::get('/proyectos', Proyectos::class)->name('proyectos');
Route::get('/proyectos/{id}', ProyectoDetalle::class)->name('proyectos.detalle');
Route::get('/proyectos/{id}/compras/{categoria}', DetalleCategoriaCompras::class)->name('proyectos.detalle.compras');
Route::get('/proyectos/{id}/tickets/{categoria}', DetalleCategoriaTickets::class)->name('proyectos.detalle.tickets');
