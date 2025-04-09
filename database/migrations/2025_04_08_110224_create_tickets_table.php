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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Ticket numbers are unique

            // Foreign key: Allow null value when a user is deleted
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            // Reference to the tire tier
            $table->unsignedBigInteger('tires_id');
            $table->foreign('tires_id')
                ->references('id')
                ->on('tires')
                ->onDelete('cascade');

            // Status can be used to denote if ticket is active, used, etc.
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
