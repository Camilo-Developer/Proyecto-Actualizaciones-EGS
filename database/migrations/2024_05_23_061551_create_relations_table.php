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
        Schema::table('users', function ($table){
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });

        Schema::table('proyects', function ($table){
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
        });

        Schema::table('subscriptions', function ($table){
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });

        Schema::table('uptproorganizations', function ($table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('cascade');
        });

        Schema::table('organizations_has_proyects', function ($table){
            $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('cascade');
            $table->foreign('proyect_id')->references('id')->on('proyects')->onUpdate('cascade');
        });

        Schema::table('uptproorganizations_has_proyects', function ($table){
            $table->foreign('uptproorganization_id')->references('id')->on('uptproorganizations')->onUpdate('cascade');
            $table->foreign('proyect_id')->references('id')->on('proyects')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
