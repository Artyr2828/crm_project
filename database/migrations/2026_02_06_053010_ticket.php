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
        Schema::create('tickets', function (Blueprint $table){
          $table->id();
          $table->foreignId('customer_id')->constrained()->onDelete('cascade');
          $table->string('subject');
          $table->text('message');
          $table->enum('status', ['new', 'in_progress', 'complete']);

          $table->timestamp('manager_data_otvet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
