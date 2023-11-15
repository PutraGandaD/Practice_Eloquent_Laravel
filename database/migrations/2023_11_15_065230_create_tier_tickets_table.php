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
        Schema::create('tier_tickets', function (Blueprint $table) {
            $table->uuid('event_id');
            $table->uuid('venue_id');
            $table->foreign('event_id')->references('id')->on('events')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('venue_id')->references('id')->on('venues')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tier_tickets');
    }
};
