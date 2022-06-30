<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for($i=0;$i <= 20; $i++){
            if($i <=10){
               $domain = '@gmail.com';
            } else if ($i > 10 && $i <= 15){
                $domain = '@clicko.com';
            } else {
                $domain = '@outlook.com';
            }

            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).$domain,
                'password' => Hash::make('password'),
            ]);
            
        } 
    }
}
