<?php

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
        $users = array(
            [
                'name' => 'Marlar',
                'email' => 'marlar@gmail.com',
                'password' => Hash::make('M@rlar12345'),
                'profile' => 'profile1.png',
                'type' => '0',
                'phone' => '09421030494',
                'address' => 'Tarmew, Yangon',
                'create_user_id' => '1',
            ],
            [
                'name' => 'Fuso',
                'email' => 'fuso@gmail.com',
                'password' => Hash::make('fu$o12345'),
                'profile' => 'profile1.png',
                'type' => '0',
                'phone' => '0956235468',
                'address' => 'SanChaung, Yangon',
                'create_user_id' => '1',
            ]
        );
        DB::table('users')->insert($users);
    }
}
