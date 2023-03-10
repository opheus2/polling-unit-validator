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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('image_id');
            $table->integer('party_id');
            $table->integer('polling_unit_id');
            $table->bigInteger('score');
            $table->string('ip_address')->nullable();
            $table->boolean('has_corrections')->default(false);
            $table->boolean('is_unclear')->default(false);
            $table->string('session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
