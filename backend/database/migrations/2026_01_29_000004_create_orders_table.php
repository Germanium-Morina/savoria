<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_name', 100);
            $table->string('customer_email', 150);
            $table->string('customer_phone', 20)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending','confirmed','preparing','ready','delivered','cancelled'])->default('pending');
            $table->enum('order_type', ['pickup','delivery'])->default('pickup');
            $table->text('delivery_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('user_id','idx_user');
            $table->index('status','idx_status');
            $table->index('created_at','idx_created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
