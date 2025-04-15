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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_comprobante', 20)->nullable();
            $table->date('fecha');
            $table->decimal('cantidad', total: 8, places: 2);
            $table->enum('tipo_comprobante', ['ingreso', 'gasto']);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('clientes_id')->constrained('clientes');
            $table->foreignId('categorias_id')->constrained('categorias');
            $table->foreignId('proyectos_id')->constrained('proyectos');
            $table->foreignId('proveedores_id')->constrained('proveedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
