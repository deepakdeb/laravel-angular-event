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
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            
            $table->tinyInteger('status')->default(0)->nullable();           
            
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->dateTime('registration_start_date')->nullable();
            $table->dateTime('registration_end_date')->nullable();
            
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->uuid('uuid')->unique(); 
            $table->timestamps();

            $table->index(['created_by', 'updated_by']);
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
