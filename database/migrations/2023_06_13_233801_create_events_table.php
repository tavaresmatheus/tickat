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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_name');
            $table->string('location');
            $table->timestamp('opening');
            $table->timestamp('closing');
            $table->foreignUuid('organizer');
            $table->foreign('organizer')
                ->references('id')
                ->on('users');
            $table->string('status');
            $table->string('category');
            $table->string('capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
