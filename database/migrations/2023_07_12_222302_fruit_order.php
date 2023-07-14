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
        Schema::create('fruit_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->nullable(false)->index();
            $table->foreignId('order_id')->nullable(false)->index();
            $table->integer("quantity");
            $table->double("price");
            $table->double("discount");
            $table->timestamps();
            $table->foreign('fruit_id')
                ->references('id')
                ->on('fruits')
                ->onDelete('cascade');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
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
