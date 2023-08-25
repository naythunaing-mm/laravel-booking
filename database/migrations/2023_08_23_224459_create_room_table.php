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
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->double('size');
            $table->mediumInteger('occupancy');
            $table->integer('bed_id');
            $table->integer('view_id');
            $table->longText('description');
            $table->longText('detail');
            $table->integer('price_per_day');
            $table->integer('extra_bed_price');
            $table->string('thumbnail',150);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('room');
    }
};
