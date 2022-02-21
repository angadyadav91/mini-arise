<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(array(
            array(
            'title' => "Pending",
            'created_at' => Carbon::now(),
            ),
            array(
            'title' => "Paid",
            'created_at' => Carbon::now(),
            ),
            array(
            'title' => "Approved",
            'created_at' => Carbon::now(),
            )
            ));
    }
}
