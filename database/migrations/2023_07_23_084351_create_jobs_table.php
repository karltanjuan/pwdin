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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade'); //foreign key
            $table->string('job_title')->nullable(false);
            $table->text('job_description')->nullable(false);
            $table->string('career_level')->nullable(false);
            $table->string('job_type')->nullable(false);
            $table->integer('years_experience');
            $table->string('job_industry')->nullable(false);
            // $table->string('company_size')->nullable(); move this to employer table
            $table->string('average_processing_time')->nullable(false);
            // $table->text('benefits')->nullable(false);
            $table->decimal('salary', 10, 2);
            $table->tinyInteger('hide_salary')->nullable(false);
            $table->string('working_days')->nullable();
            $table->string('pwd_categories')->nullable();
            $table->text('qualification')->nullable(false);
            $table->string('work_setup')->nullable(false);
            $table->tinyInteger('status')->nullable(false); // 0 - Inactive, 1 - Active, 2 - Disabled
            // $table->text('disclaimer')->nullable();
            $table->date('closed_at')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        
    }
};
