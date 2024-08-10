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
        Schema::create('logsuptproorgs', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->bigInteger('uptproorganization_id')->nullable()->unsigned()->comment('Actualizacion de projecto de la organizacion');
            $table->bigInteger('proyect_id')->nullable()->unsigned()->comment('Proyecto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logsuptproorgs');
    }
};
