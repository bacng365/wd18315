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
        Schema::create('users', function (Blueprint $table) {
            // $table->id(); 
            $table->increments('id'); // id không âm
            $table->string('name', 20);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            // $table->string('remember_token', 100)->nullable();
            $table->rememberToken();
            $table->string('address', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->enum('role', ['1', '2'])->default('2')->comment('1: Admin, 2: User');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function(Blueprint $table) {
        //     $table->dropColumn(['role']);
        // });
        Schema::dropIfExists('users');
    }
};
