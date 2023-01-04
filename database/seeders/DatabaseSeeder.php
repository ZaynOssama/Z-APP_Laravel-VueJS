<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$user = new User;
        $user->name = 'admin';
        $user->email = 'admin@dev.com';
        $user->password = 'r00t';
        $user->role = 'admin';
        $user->save();*/
        $user = new User;
        $user->name = 'zayn';
        $user->email = 'zayn@dev.com';
        $user->password = bcrypt('r00t');
        $user->role = 'admin';

        $user->save();

        $this->call([
            UserSeeder::class
        ]);
    }
}
