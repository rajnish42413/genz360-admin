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
			'name' => 'Rajnish Singh',
			'email' => 'sudo@sudo.com',
			'username' => 'rajnish42413',
			'password' => bcrypt('raj 21071'),
			'type' => 'admin',
		]);
		factory(App\User::class, 1000)->create();
    }
}
