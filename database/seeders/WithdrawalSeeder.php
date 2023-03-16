<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('withdrawals')->insert([
        //     'amount_withdrawn'=>100,
        //       'balance'=>0,
        //       'user_id'=>0
        //   ]);
        Withdrawal::factory()->count(4)->create();
    }
}
