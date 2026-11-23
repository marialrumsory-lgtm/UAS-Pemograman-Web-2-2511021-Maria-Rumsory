<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();                                   // BIGINT UNSIGNED, PK, auto increment
            $table->string('title', 80);
            $table->string('author', 60);
            $table->string('category', 40);
            $table->unsignedSmallInteger('year');
            $table->string('synopsis', 240)->nullable();
            $table->timestamps();
            $table->text('description')->nullable();
            $table->string('cover')->nullable(); // Tambahkan baris ini
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
