<?php

use App\User;
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
    	User::create([
    		'name' => 'santos',
        	'email' => 'san@h.com',
        	'password' => bcrypt('123123')
    	]);
    }
}
