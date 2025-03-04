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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->string('title');
            $table->text('url');
            $table->text('text');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
