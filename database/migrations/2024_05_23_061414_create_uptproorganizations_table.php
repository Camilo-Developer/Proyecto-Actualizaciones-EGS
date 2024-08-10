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
        Schema::create('uptproorganizations', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('Usuario');
            $table->bigInteger('organization_id')->nullable()->unsigned()->comment('Organización');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uptproorganizations');
    }
};
