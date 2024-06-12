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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->integer('edad');
            $table->string('ciudad');
            $table->string('curso');
            $table->string('foto');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
