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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('message_id');
            $table->integer("marks")->nullable();
            $table->enum('state', ['neutral', 'valid','rejected'])->default('neutral');
            $table->string('name');
            $table->string('type');
            $table->integer('size');
            $table->string('path');

            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('message_id')->references('id')->on('messages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
