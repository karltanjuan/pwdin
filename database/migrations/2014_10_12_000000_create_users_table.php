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
        // this is where database schema is set
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable(false);
            $table->string('prefix')->nullable();
            $table->string('pwd_category')->nullable(false);
            $table->date('birthdate')->nullable(false);
            $table->string('gender')->nullable(false);
            $table->string('mobile_no', 12)->nullable();
            $table->string('education_level')->nullable();
            $table->text('address')->nullable(false);
            $table->string('province')->nullable(false);
            $table->string('city')->nullable(false);
            $table->text('summary')->nullable();
            $table->string('zip_code')->nullable(false);
            $table->string('profile_photo')->nullable(false);
            $table->string('resume')->nullable(false);
            $table->string('pwd_card')->nullable(false);
            $table->tinyInteger('status')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token')->nullable();
            $table->date('token_expired_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
