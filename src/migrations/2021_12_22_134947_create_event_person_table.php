<?php

use Database\Models\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// @codingStandardsIgnoreLine
class CreateEventPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->foreignId('person_id');
            $table->foreignId('transaction_id')->nullable()->default(null);
            $table->json('data');
            $table->timestamps();
            $table->unique(['event_id', 'person_id']);
        });

        Config::create(['name' => 'events.transaction', 'value' => 'Event #{event.id}']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Config::destroy('events.transaction');
        Schema::dropIfExists('event_people');
    }
}
