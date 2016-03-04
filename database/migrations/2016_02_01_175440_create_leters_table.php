<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leters', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('bag_id', 36);
            $table->string('title', 90);
            $table->text('content');
            $table->string('hash_content', 40);            
            $table->timestamps();

            $table->foreign('bag_id')->references('id')->on('bags')->on_delete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leters');
    }
}
