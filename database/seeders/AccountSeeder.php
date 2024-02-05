<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'id' => '0',
            'user_type' => 'App\Models\User',
            'user_id' => 1,
            'balance'=>0,
            'status'=>'approved',
        ]);
    }
}
