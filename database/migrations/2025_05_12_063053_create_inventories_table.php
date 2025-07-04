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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->string('serial_number');
            $table->date('date_in');
            $table->date('date_out')->nullable();
            $table->string('pic')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['received', 'on_progress', 'done', 'returned', 'broken']);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
