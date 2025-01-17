<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('active_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->enum('delivery_method', ['pickup', 'delivery']);
            $table->string('address')->nullable();
            $table->enum('payment_method', ['cash', 'card', 'online']);
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->timestamps();
            $table->string('city')->nullable()->after('address');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('phone')->nullable()->after('postal_code');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->after('restaurant_id');
        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('active_orders');
    }
};
