<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://www.udemy.com',
        ]);

        // $user->perfil()->create();

        User::create([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://www.udemy.com',
        ]);

        // $user2->perfil()->create();

        // DB::table('users')->insert([

        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        // DB::table('users')->insert([

        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
    }
}
