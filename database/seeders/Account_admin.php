<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Account_admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_admins')->insert([
            'id' => 0,
            'admin_type' => 'App\Models\User',
            'admin_id' => 1,
            'balance'=>0,
        ]);
    }
}
