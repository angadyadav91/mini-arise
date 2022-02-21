<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => "Ramsay",
            'api_token' => 'aFNEZlRlN1VoOVpiN29pWUIxcmVPOVpnd3E5MHRkNFM=',
            ]);
    }
}
