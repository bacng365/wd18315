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
        Schema::table('products', function(Blueprint $table) {
            // Thêm mới 
            $table->string('image', 500);
            // Sửa
            $table->string('name', 250)->change();
            // Xóa
            $table->dropColumn(['view']);
            // Rename(Lưu ý: Xampp không hỗ trợ phương thức rename)
            // $table->renameColumn('price', 'product_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn(['image']);
            $table->string('name', 200)->change();
            $table->integer('view');
            // $table->renameColumn('product_price', 'price');
        });
    }
};
