<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatrooms', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->enum('chatroom_type', ['Private', 'Group'])->default('Private');
            $table->string('chatroom_name')->nullable();

            $table->uuid('admin_id');
            $table->foreign('admin_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('chatrooms');
    }
}
