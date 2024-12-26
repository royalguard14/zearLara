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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('firstname');
        $table->string('lastname');
        $table->string('phone_number')->nullable();  // Optional phone number
        $table->string('address')->nullable();  // Optional address
        $table->string('profile_picture')->nullable();  // Optional profile picture URL
        $table->date('birthdate')->nullable();  // Optional birthdate
        $table->string('gender')->nullable();  // Optional gender field
        $table->string('nationality')->nullable();  // Optional nationality
        $table->text('bio')->nullable();  // Optional short biography
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
