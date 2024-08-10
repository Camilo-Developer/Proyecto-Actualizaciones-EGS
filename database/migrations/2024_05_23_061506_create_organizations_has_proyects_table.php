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
        Schema::create('organizations_has_proyects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable()->unsigned()->comment('Organización');
            $table->bigInteger('proyect_id')->nullable()->unsigned()->comment('Proyecto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations_has_proyects');
    }
};
