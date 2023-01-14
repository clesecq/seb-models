<?php

use Database\Models\ProductCategory;
use Database\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('person_id')->references('id')->on('people');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('product_categories');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('category_id')->references('id')->on('transaction_categories');
        });

        Schema::table('movements', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('product_movement', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('movement_id')->references('id')->on('movements');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('movement_id')->references('id')->on('movements');
            $table->foreign('person_id')->references('id')->on('people');
        });

        Schema::table('account_counts', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });

        Schema::table('product_counts', function (Blueprint $table) {
            $table->foreign('movement_id')->references('id')->on('movements');
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('movement_id')->references('id')->on('movements');
        });

        Schema::table('transferts', function (Blueprint $table) {
            $table->foreign('sub_transaction_id')->references('id')->on('transactions');
            $table->foreign('add_transaction_id')->references('id')->on('transactions');
        });

        Schema::table('archived_members', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('person_id')->references('id')->on('people');
        });

        Schema::table('automated_transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('category_id')->references('id')->on('transaction_categories');
        });

        Schema::table('personal_accounts', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('people');
        });

        Schema::table('personal_transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_account_id')->references('id')->on('personal_accounts');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('people');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('transaction_categories');
        });

        Schema::table('event_people', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });

        Schema::table('fast_auth_tokens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['transaction_id', 'person_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'account_id', 'category_id']);
        });

        Schema::table('movements', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('product_movement', function (Blueprint $table) {
            $table->dropForeign(['product_id', 'movement_id']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['transaction_id', 'movement_id', 'person_id']);
        });

        Schema::table('account_counts', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
        });

        Schema::table('product_counts', function (Blueprint $table) {
            $table->dropForeign(['movement_id']);
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['transaction_id', 'movement_id']);
        });

        Schema::table('transferts', function (Blueprint $table) {
            $table->dropForeign(['sub_transaction_id', 'add_transaction_id']);
        });

        Schema::table('archived_members', function (Blueprint $table) {
            $table->dropForeign(['transaction_id', 'person_id']);
        });

        Schema::table('automated_transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'account_id', 'category_id']);
        });

        Schema::table('personal_accounts', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
        });

        Schema::table('personal_transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'personal_account_id', 'transaction_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('event_people', function (Blueprint $table) {
            $table->dropForeign(['event_id', 'person_id', 'transaction_id']);
        });

        Schema::table('fast_auth_tokens', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
