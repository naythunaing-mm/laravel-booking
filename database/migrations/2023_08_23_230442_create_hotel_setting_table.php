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
        Schema::create('hotel_setting', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->longText('address');
            $table->string('checkin',20);
            $table->string('checkout',20);
            $table->string('online_phone',40);
            $table->string('outline_phone',40);
            $table->string('size_unit',20);
            $table->string('occupancy',30);
            $table->string('price_unit',30);
            $table->string('logo',150)->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_setting');
    }
};
