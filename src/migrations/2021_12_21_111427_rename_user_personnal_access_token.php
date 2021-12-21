<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameUserPersonnalAccessToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("personal_access_tokens")->where('tokenable_type', 'App\Models\User')->update(['tokenable_type' => 'Database\Models\User']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("personal_access_tokens")->where('tokenable_type', 'Database\Models\User')->update(['tokenable_type' => 'App\Models\User']);
    }
}
