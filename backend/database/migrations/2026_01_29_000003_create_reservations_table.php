<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('phone', 20)->nullable();
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('number_of_guests');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending','confirmed','cancelled','completed'])->default('pending');
            $table->timestamps();
            $table->index('user_id','idx_user');
            $table->index(['reservation_date','reservation_time'],'idx_date_time');
            $table->index('status','idx_status');
            $table->index('email','idx_email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
