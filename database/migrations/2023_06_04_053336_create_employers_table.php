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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable(false);
            $table->string('contact_person')->nullable(false);
            $table->string('mobile_no', 12)->nullable();
            
            $table->string('company_name')->nullable(false);
            $table->text('address')->nullable(false);
            $table->string('province')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('zip_code')->nullable(false);
            $table->text('summary')->nullable();

            $table->string('company_logo')->nullable(false);
            $table->string('business_permit')->nullable(false);
            $table->string('bir_certificate')->nullable(false);
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
        Schema::dropIfExists('employers');
    }
};
