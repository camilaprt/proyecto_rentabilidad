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
        Schema::table('comprobantes', function (Blueprint $table) {
            // Eliminar las columnas tipo_comprobante y estado
            $table->dropColumn(['tipo_comprobante', 'estado']);

            // Agregar la columna tipo_comprobante_id como FK
            $table->foreignId('tipo_comprobante_id')->constrained('tipo_comprobantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            // Revertir la eliminación de las columnas
            $table->enum('tipo_comprobante', ['ingreso', 'gasto']);
            $table->tinyInteger('estado')->default(1);

            // Eliminar la FK tipo_comprobante_id
            $table->dropForeign(['tipo_comprobante_id']);
            $table->dropColumn('tipo_comprobante_id');
        });
    }
};
