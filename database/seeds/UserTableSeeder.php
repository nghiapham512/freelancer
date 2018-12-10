<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_account')->truncate();
        App\User::create([
            'username' => 'admin',
            'email' =>'nghiapham512@gmail.com',
            'password' => bcrypt('freelancer512')
        ]);
    }
}
