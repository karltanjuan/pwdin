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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable(false);
            $table->string('mobile_no', 12)->nullable();
            $table->string('first_name')->nullable(false);
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable(false);
            $table->string('prefix')->nullable();
            $table->string('profile_photo')->nullable();
            $table->tinyInteger('role')->default(3); // Admin = 1, Staff = 2, Customer = 3
            $table->tinyInteger('status')->nullable(false);
            $table->string('token')->nullable();
            $table->date('token_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
