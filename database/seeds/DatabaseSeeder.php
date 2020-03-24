<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new User;
        $user->name = 'dpithwa';
        $user->username = 'dpithwa';
        $user->voting_link = '/';
        $user->password = Hash::make('codal123');
        $user->type = 1;
        $user->save();
    }
}
