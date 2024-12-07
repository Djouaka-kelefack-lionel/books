<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('session_id');
            $table->enum('type', ['like', 'dislike']);
            $table->timestamps();
            $table->unique(['book_id', 'session_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}; 