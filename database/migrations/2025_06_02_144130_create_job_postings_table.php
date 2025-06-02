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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employers')->onDelete('cascade');
            $table->string('job_title');
            $table->string('company_name')->nullable();
            $table->string('category')->nullable();
            $table->text('description');
            $table->string('salary')->nullable();
            $table->integer('vacancy')->nullable();
            $table->string('experience')->nullable();
            $table->string('logo')->nullable();
            $table->string('job_type')->nullable();
            $table->text('requirement')->nullable();
            $table->text('skill')->nullable();
            $table->string('proof')->nullable();
            $table->date('deadline')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('facebook')->nullable();
            $table->string('X')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
