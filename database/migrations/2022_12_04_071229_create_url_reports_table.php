<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_shortners_id');
            $table->foreign('url_shortners_id')->references('id')->on('url_shortners');
            $table->string('url_prefix');
            $table->string('click');
            $table->string('device_details');
            $table->string('browser_details');
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
        Schema::dropIfExists('url_reports');
    }
};
