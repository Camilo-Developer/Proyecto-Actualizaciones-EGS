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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->date('date_init')->comment('Fecha de inicio');
            $table->date('date_finish')->comment('Fecha final');
            $table->bigInteger('organization_id')->nullable()->unsigned()->comment('Organización');
            $table->bigInteger('state_id')->nullable()->unsigned()->comment('Estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
