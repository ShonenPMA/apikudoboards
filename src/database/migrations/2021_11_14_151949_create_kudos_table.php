<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kudos', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            
            $table->foreignId('kudoboard_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_sender_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('user_receiver_id')
                ->constrained('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('kudos');
    }
}
