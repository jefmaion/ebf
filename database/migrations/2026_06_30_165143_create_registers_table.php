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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('childname');
            $table->date('childbirthdate');
            $table->string('childage');
            $table->string('childgender');
            $table->string('childchurch')->nullable();
            $table->boolean('agree')->default(false);
            $table->string('hash')->nullable();

            $table->datetime('checkin_date')->nullable();
            $table->datetime('checkout_date')->nullable();

            $table->integer('user_id_checkin')->nullable();
            $table->integer('user_id_checkout')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
