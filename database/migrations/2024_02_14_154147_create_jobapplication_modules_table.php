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
        Schema::create('jobapplication', function (Blueprint $table) {
            $table->id('job_application_id');

            $table->text('proposal');
            $table->json('files');



            $table->unsignedBigInteger('Hirer_id');
            $table->foreign('Hirer_id')->references('user_id')->on('user');

            $table->unsignedBigInteger('Freelancer_id');
            $table->foreign('Freelancer_id')->references('user_id')->on('user');
            

            $table->unsignedBigInteger('job_post_id');
            $table->foreign('job_post_id')->references('job_post_id')->on('jobpost');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobapplication');
    }
};
