<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create([
            'name' => 'Simranjit Kaur',
            'email' =>'simranindiit@gmail.com',
            'username' =>'simran_94',
            'password' => Hash::make('Demo@123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'country' => 1
        ]);
    }
}
