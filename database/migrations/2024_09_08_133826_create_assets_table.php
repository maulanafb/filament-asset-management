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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->string('name');
            $table->string('image');
            $table->integer('qty');
            $table->decimal('price', 8, 2);
            $table->foreignId('brand_id');
            $table->foreignId('category_id');
            $table->foreignId('room_id');
            $table->enum('condition', ["new","used","damaged"]);
            $table->date('purchase_date');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
