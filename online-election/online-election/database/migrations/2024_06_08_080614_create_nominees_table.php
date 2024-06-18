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
        Schema::create('candidate', function (Blueprint $table) {
            $table->id('candidate_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->foreignId('election_id')->constrained('election', 'eid');
            $table->binary('cv');
            $table->enum('status', ['pending', 'accepted', 'denied']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominees');
    }
};
