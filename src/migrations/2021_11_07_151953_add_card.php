<?php

use Database\Models\Account;
use Database\Models\Config;
use Database\Models\TransactionCategory;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class AddCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Account::create(['id' => 2, 'name' => 'Card account']);
        TransactionCategory::create(['id' => 6, 'name' => 'Card fees']);
        Config::create(['name' => 'card.account', 'value' => '2']);
        Config::create(['name' => 'card.fees.percent', 'value' => '0.0175']);
        Config::create(['name' => 'card.fees.message', 'value' => 'Card fees #{transaction.id}']);
        Config::create(['name' => 'card.fees.category', 'value' => '6']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
