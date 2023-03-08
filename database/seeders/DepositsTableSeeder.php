<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepositsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deposit::create(
            [
                 'user_id' =>User::all()->unique()->random()->id,
                 'amount_deposited'=>500,
                 'balance'=>0,
             ],
             [
                 'user_id' => User::all()->unique()->random()->id,
                 'amount_deposited'=>500,
                 'balance'=>0,
             ],
             [
                 'user_id' =>User::all()->unique()->random()->id,
                 'amount_deposited'=>500,
                 'balance'=>0,
             ]
         );
    }
}
