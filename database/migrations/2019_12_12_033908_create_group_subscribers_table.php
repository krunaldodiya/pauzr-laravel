<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_subscribers', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->uuid('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->boolean('is_admin')->default(false);
            $table->timestamps();

            $table->primary(['user_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_subscribers');
    }
}
