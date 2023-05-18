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
        Schema::table('users', function (Blueprint $table) {
            
            $table->boolean('estado');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('numTarjeta');
            $table->string('tipoSocio');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropColumn('nombre');
            $table->dropColumn('direccion');
            $table->dropColumn('telefono');
            $table->dropColumn('telefono');
            $table->dropColumn('numTarjeta');
            $table->dropColumn('tipoSocio');
        });
    }
};
