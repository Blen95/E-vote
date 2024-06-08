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
            $table->id(); // Primary key column
            $table->foreignId('candidate_id')->constrained('users', 'user_id')->onDelete('cascade'); // Define candidate_id as a foreign key to user_id in users table
            $table->foreignId('nominee_id')->constrained('nominee', 'nominee_id')->onDelete('cascade'); // Ensure this column exists in nominees table
            $table->foreignId('election_id')->constrained('election', 'eid')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate');
    }
};
