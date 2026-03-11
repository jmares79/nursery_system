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
        Schema::create('child_guardian', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guardian_id')->constrained()->cascadeOnDelete();
            $table->string('relationship')->nullable(); // mother, father, guardian
            $table->boolean('is_authorised_pickup')->default(true);
            $table->boolean('is_primary_contact')->default(false);
            $table->boolean('has_parental_responsibility')->default(false);

            $table->timestamps();

            $table->unique(['child_id', 'guardian_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_guardian');
    }
};
