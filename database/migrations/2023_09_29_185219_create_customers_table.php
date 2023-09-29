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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->double('balance')->default(0)->nullable();
            $table->text('address')->nullable();
            $table->longText('bio')->nullable();
            $table->date('birthday')->nullable();
            $table->time('time')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->longText('html')->nullable();
            $table->json('info')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
