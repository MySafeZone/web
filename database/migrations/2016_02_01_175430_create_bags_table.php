<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->integer('user_id')->unsigned();
            $table->text('recipients');
            $table->string('title', 90);
            $table->tinyInteger('periodicity');
            $table->longtext('shares');
            $table->text('public_key');
            $table->dateTime('disable_at')->nullable()->default(null);
            $table->dateTime('send_at')->nullable()->default(null);
            $table->dateTime('first_reminder_at')->nullable()->default(null);
            $table->dateTime('second_reminder_at')->nullable()->default(null);
            $table->dateTime('end_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->on_delete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bags');
    }
}
