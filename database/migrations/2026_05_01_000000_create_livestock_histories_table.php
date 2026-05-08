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
        Schema::create('livestock_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('livestock_id')->constrained('livestock')->onDelete('cascade');

            $table->string('event_type'); // Vaccination, Treatment, Checkup, Illness, Deworming, Surgery
            $table->text('description')->nullable();
            $table->date('event_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_histories');
    }
};
