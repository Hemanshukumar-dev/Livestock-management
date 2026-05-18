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
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('animal_type')->nullable();
            $table->string('scheme_type')->default('State'); // State or Central
            $table->text('eligibility');
            $table->text('benefits');
            $table->date('deadline')->nullable();
            $table->string('apply_link')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
