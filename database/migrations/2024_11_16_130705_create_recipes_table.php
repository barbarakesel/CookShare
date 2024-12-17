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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('ingredients');
            $table->text('steps');
            $table->string('image_path');
            $table->decimal('rating', 3, 1); // 4.8
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // assuming you have a users table
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->nullable();

            // Добавляем внешний ключ (если у вас есть таблица категорий)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
