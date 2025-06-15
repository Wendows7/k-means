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
        Schema::create('iteration_final_grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('npm');
            $table->string('semester_5_1');
            $table->string('semester_5_2');
            $table->string('semester_6_1');
            $table->string('semester_6_2');
            $table->string('semester_7_1');
            $table->string('semester_7_2');
            $table->string('profile_kelulusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iteration_final_grades');
    }
};
