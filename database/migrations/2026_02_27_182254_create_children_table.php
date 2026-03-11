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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nickname')->nullable();
            $table->date('date_of_birth');

            $table->foreignId('room_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('key_worker_id')
                ->nullable()
                ->constrained('staff')
                ->nullOnDelete();

            $table->text('allergies')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreignId('address_id')->nullable();

            $table->string('gender')->nullable();

            $table->boolean('special_educational_needs')->default(false);
            $table->text('medical_notes')->nullable();
            $table->text('dietary_requirements')->nullable();
            $table->string('additional_languages')->nullable();

            $table->string('religion')->nullable();
            $table->string('ethnic_origin')->nullable();

            $table->string('funding_type')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
