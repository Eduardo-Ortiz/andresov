<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'password' => bcrypt('R3fugio'),
            'email' => 'eduort11@gmail.com',
            'name' => 'Eduardo Ortiz'
        ]);
    }
}
