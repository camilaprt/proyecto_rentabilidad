<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_fra',20);
            $table->date('fecha');
            $table->decimal('base_imp',total:8,places:2);
            $table->decimal('total',total:8,places:2);
             $table->foreignId('clientes_id')->constrained('clientes');
            $table->foreignId('categorias_id')->constrained('categorias');
            $table->foreignId('proyectos_id')->constrained('proyectos');
            $table->foreignId('proveedores_id')->constrained('proveedores');
            $table->foreignId('tipo_factura_id')->constrained('tipo_facturas');
            $table->foreignId('tipo_impuesto_id')->constrained('tipo_impuestos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
