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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->cascadeOnDelete();
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();

            $table->foreignId('checked_in_by')
                ->nullable()
                ->constrained('staff')
                ->nullOnDelete();

            $table->foreignId('checked_out_by')
                ->nullable()
                ->constrained('staff')
                ->nullOnDelete();

            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
