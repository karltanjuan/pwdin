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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->unsigned();
            $table->bigInteger('applicant_id')->unsigned();
            $table->text('cover_letter')->nullable(true);
            $table->string('status')->nullable(false);
            $table->tinyInteger('is_rejected')->nullable(false);
            $table->string('rejected_reason')->nullable(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
