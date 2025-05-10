<?php

use App\Livewire\GestionClientes;
use App\Livewire\GestionProveedores;
use App\Livewire\Compras;
use App\Livewire\Categorias;
use App\Livewire\CrearFactura;
use App\Livewire\CrearTicket;
use App\Livewire\Ventas;
use App\Livewire\Proyectos;
use App\Livewire\ProyectoDetalle;
use App\Livewire\DetalleCategoriaCompras;
use App\Livewire\DetalleCategoriaTickets;
use App\Livewire\DetalleCategoriaVentas;

use App\Http\Controllers\AuthController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
//cambiar cuando app este lista
Route::get('/', [AuthController::class, 'showLogin'])->name('home');


//User not autheticated yet
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});



//Protect routes from unauthenticated users
Route::middleware('auth')->group(function () {
    Route::get('/clientes', GestionClientes::class)->name('clientes');
    Route::get('/proveedores', GestionProveedores::class)->name('proveedores');
    Route::get('/compras', Compras::class)->name('compras');
    Route::get('/categorias', Categorias::class)->name('categorias');
    Route::get('/compras/crearTicket/{proyecto_id?}', CrearTicket::class)->name('compras.crearticket');
    Route::get('/{tipo}/editarticket/{id}', CrearTicket::class)->name('compras.editarticket');
    Route::get('/ventas', Ventas::class)->name('ventas');
    Route::get('/{tipo}/crearfactura/{proyecto_id?}', CrearFactura::class)->name('crearfactura');
    Route::get('/{tipo}/editarfactura/{id}', CrearFactura::class)->name('editarfactura');
    Route::get('/proyectos', Proyectos::class)->name('proyectos');
    Route::get('/proyectos/{id}', ProyectoDetalle::class)->name('proyectos.detalle');
    Route::get('/proyectos/{id}/compras/{categoria}', DetalleCategoriaCompras::class)->name('proyectos.detalle.compras');
    Route::get('/proyectos/{id}/tickets/{categoria}', DetalleCategoriaTickets::class)->name('proyectos.detalle.tickets');
    Route::get('/proyectos/{id}/{categoria}', DetalleCategoriaVentas::class)->name('proyectos.detalle.ventas');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
