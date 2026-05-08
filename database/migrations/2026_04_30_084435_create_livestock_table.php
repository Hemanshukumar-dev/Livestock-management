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
        Schema::create('livestock', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key linking to owners table
            $table->foreignId('owner_id')->constrained()->onDelete('cascade');

            $table->string('type'); // cow, goat, buffalo
            $table->string('breed'); // breed type
            $table->integer('age'); // age in years
            $table->string('health_status'); // healthy, sick, etc.

            $table->string('tag_number')->unique();
            $table->enum('source', ['Born', 'Purchased'])->default('Born');
            $table->date('date_added')->nullable();

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock');
    }
};