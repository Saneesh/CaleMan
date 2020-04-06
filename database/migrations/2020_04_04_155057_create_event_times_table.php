<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_times', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->date('event_date_id');
            $table->time('slot_start');
            $table->time('slot_end');
            $table->boolean('is_scheduled')->default(false);

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
        Schema::dropIfExists('event_times');
    }
}
