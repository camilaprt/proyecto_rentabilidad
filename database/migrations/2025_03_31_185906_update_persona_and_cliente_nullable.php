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
        Schema::table('personas', function (Blueprint $table) {
            $table->string('direccion')->nullable()->change();
        });
        //Para permitir a Filament crear la persona antes que el cliente en ClienteResource
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('persona_id')->nullable()->change();
        });
        //Para permitir a Filament crear la persona antes que el proveedor en ProveedoreResource
        Schema::table('proveedores', function (Blueprint $table) {
            $table->foreignId('persona_id')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->string('direccion')->nullable(false)->change();
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('persona_id')->nullable(false)->change();
        });

        Schema::table('proveedore', function (Blueprint $table) {
            $table->foreignId('persona_id')->nullable(false)->change();
        });
    }
};
