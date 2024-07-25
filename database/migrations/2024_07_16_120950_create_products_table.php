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
            $table->increments('product_id'); // integer | unsigned | primary key | auto increment
            $table->string('name', 20);
            $table->string('description', 500);
            $table->float('price', 10, 2)->default(800.02);
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
