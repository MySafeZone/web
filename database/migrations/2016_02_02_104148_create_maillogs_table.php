<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaillogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maillogs', function (Blueprint $table) {
            $table->increments('id');
            // http://stackoverflow.com/questions/30079128/maximum-internet-email-message-id-length
            $table->text('message_id');
            // http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
            $table->string('to', 254);
            $table->datetime('send_at');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maillogs');
    }
}
