<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('menu_item_id')->constrained('menu_items')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->timestamps();
            $table->index('user_id', 'idx_cart_user');
            $table->index('menu_item_id', 'idx_cart_menu_item');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
