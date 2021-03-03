<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQBOAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qbo_auths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('access_token');
            $table->string('refresh_token');
            $table->datetime('x_refresh_token_expires_in');
            $table->datetime('expires_in');
            $table->string('token_type');
            $table->string('realm_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('qbo_auths');
    }
}
