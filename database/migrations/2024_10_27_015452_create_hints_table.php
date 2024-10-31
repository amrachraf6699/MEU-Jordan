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
        Schema::create('hints', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('language')->nullable();
            $table->string('date_of_publication')->nullable();
            $table->string('sort')->nullable();
            $table->string('sources')->nullable();
            $table->string('indexing')->nullable();
            $table->string('evidences')->nullable();
            $table->string('documentaion_period')->nullable();
            $table->string('academic_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hints');
    }
};
