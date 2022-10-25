<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_user = array('name' => 'daniela', 'email' => 'daniellakhouri@hotmail.com', 'password' => bcrypt('abc123home!*'));
        $user = new User($data_user);
        $user->save();

    }
}
