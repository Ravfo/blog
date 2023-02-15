<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = User::create([
            'name'=>'Sergio Zavala',
            'email'=>'serrave@yahoo.com',
            'password'=>bcrypt('sistemas')

        ]);
        $user->assignRole('Admin');
        User::factory(9)->create();
    }
}
