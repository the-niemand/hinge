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
        Schema::create('portfolio', function (Blueprint $table) {
            $table->id('portfolio_id');
            $table->string('title');
            $table->text('description');
            $table->string('images');
            $table->timestamp('created_at')->default(now());
            $table->index('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_modules');
    }
};


// [{'language' : 'English' , 'proficiency' : 'Bacic'},{'language' : 'Arabic' , 'Fluently' : 'Bacic'},{'language' : 'Spanish' , 'proficiency' : 'Bacic'}]