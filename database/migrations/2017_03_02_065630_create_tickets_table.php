<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->nullable();
            $table->integer('user_id');
            $table->string('token_no');
            $table->string('subject', 300)->nullable();
            $table->string('description', 10000)->nullable();
            $table->enum('priority',['low', 'medium', 'high'])->nullable();
            $table->enum('status',['open', 'replied', 'closed', 'pending'])->nullable();
            $table->integer('assigned_to')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Complaints');
    }
}
