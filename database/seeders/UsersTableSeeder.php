<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name'=>'Jane Doe',
            'email'=>'janedoe@gmail.com',
            'password'=>Hash::make('password'),
            'subscription'=>'weeekly',
            'contact'=>'0562849027',
            'address'=>'Accra,Ghana.Oyibi',
            'Next_of_kin_fullname'=>'Janet Doe',
            'Next_of_kin_address'=>'Accra,Ghana.lapaz',
            'Next_of_kin_contact'=>'749207638',
        ]);
    }
}
