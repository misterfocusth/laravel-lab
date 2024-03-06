<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title')->unique();
            $table->longText('description');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('publisher');
            $table->integer('pages');
            $table->enum('rating', ['EVERYONE', 'TEEN', 'ADULT']);
            $table->date('release_date');
            $table->string('cover_image')->nullable();
            $table->unsignedDouble('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
