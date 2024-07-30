<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // PHP artisan migrate
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // integer | unsigned | primary key | auto increment
            $table->string('name');
            $table->double('price', 8, 2);
            $table->string('image', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // PHP artisan rollback|reset
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
