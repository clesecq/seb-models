<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFastAuthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fast_auth_tokens', function (Blueprint $table) {
            $table->string('token')->unique();
            $table->foreignId('user_id')->nullable();
            $table->boolean('accepted')->default(false);
            $table->timestamp('created_at', $precision = 0);
            $table->primary('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fast_auth_tokens');
    }
}
