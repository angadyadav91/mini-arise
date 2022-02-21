<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        'name' => "Admin",
        'api_token' => 'QXZkOXhnUGhQZE1jNmxpYWhZNndmdkh4TlA2UnE2aUc=',
        ]);
    }
}
