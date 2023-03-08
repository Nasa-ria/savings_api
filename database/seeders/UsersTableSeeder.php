<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    use HasFactory; 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'full_name'=>'Jane Doe',
            'email'=>'janedoe1@gmail.com',
            'password'=>Hash::make('password'),
            'subscription'=>'weeekly',
            'contact'=>'0562849027',
            'address'=>'Accra,Ghana.Oyibi',
            'Next_of_kin_fullname'=>'Janet Doe',
            'Next_of_kin_address'=>'Accra,Ghana.lapaz',
            'Next_of_kin_contact'=>'749207638',
            ],
            [
                'full_name'=>'Jane Doe',
                'email'=>'janedoe2@gmail.com',
                'password'=>Hash::make('password'),
                'subscription'=>'weeekly',
                'contact'=>'0562849027',
                'address'=>'Accra,Ghana.Oyibi',
                'Next_of_kin_fullname'=>'Janet Doe',
                'Next_of_kin_address'=>'Accra,Ghana.lapaz',
                'Next_of_kin_contact'=>'749207638',
            ],
            [
                'full_name'=>'Jane Doe',
                'email'=>'jane90doe3@gmail.com',
                'password'=>Hash::make('password'),
                'subscription'=>'weeekly',
                'contact'=>'0562849027',
                'address'=>'Accra,Ghana.Oyibi',
                'Next_of_kin_fullname'=>'Janet Doe',
                'Next_of_kin_address'=>'Accra,Ghana.lapaz',
                'Next_of_kin_contact'=>'749207638',
            ],
               [
                'full_name'=>'Jane Doe',
                'email'=>'jane90doe36@gmail.com',
                'password'=>Hash::make('password'),
                'subscription'=>'weeekly',
                'contact'=>'0562849027',
                'address'=>'Accra,Ghana.Oyibi',
                'Next_of_kin_fullname'=>'Janet Doe',
                'Next_of_kin_address'=>'Accra,Ghana.lapaz',
                'Next_of_kin_contact'=>'749207638',
               ]
    );


    //     User::factory()->create([
    //         'full_name'=>'Jane Doe',
    //         'email'=>'janedoe@gmail.com',
    //         'password'=>Hash::make('password'),
    //         'subscription'=>'weeekly',
    //         'contact'=>'0562849027',
    //         'address'=>'Accra,Ghana.Oyibi',
    //         'Next_of_kin_fullname'=>'Janet Doe',
    //         'Next_of_kin_address'=>'Accra,Ghana.lapaz',
    //         'Next_of_kin_contact'=>'749207638',
    //     ]);

    //    $user = User::factory()->create([
    //     'full_name'=>'Jane Doe',
    //     'email'=>'jane90doe@gmail.com',
    //     'password'=>Hash::make('password'),
    //     'subscription'=>'weeekly',
    //     'contact'=>'0562849027',
    //     'address'=>'Accra,Ghana.Oyibi',
    //     'Next_of_kin_fullname'=>'Janet Doe',
    //     'Next_of_kin_address'=>'Accra,Ghana.lapaz',
    //     'Next_of_kin_contact'=>'749207638',
    //    ])->first();

   

    }

   }
    

