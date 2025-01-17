<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
        $table->text('description')->nullable();
        $table->integer('stars')->unsigned()->between(1, 5);
        $table->timestamps();
        $table->unsignedBigInteger('order_id')->nullable()->after('restaurant_id');
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    
    });
}

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
