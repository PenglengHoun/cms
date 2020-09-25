<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'RemG',
            'email' => 'remg@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Rem',
            'email' => 'rem@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
