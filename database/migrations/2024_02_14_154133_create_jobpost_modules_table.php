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
        Schema::create('jobpost', function (Blueprint $table) {
            $table->id('job_post_id');
            $table->string('title');
            $table->text('description');
            $table->string('target_country');
            $table->string('Jtype');
            $table->string('Duration');
            $table->float ('Job_time')->nullable();
            $table->float('price');
            $table->string('level');
            $table->json('skills_required');

            $table->unsignedBigInteger('Hirer_id');
            $table->foreign('Hirer_id')->references('user_id')->on('user');
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobpost');
    }
};
