<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = [
            'name' => 'developer',
            'login_id' => 'test1234',
            'password' => Hash::make('password'),
            'role' => 1,
        ];

        $admin = [
            [
                'name' => 'admin',
                'login_id' => 'test12345',
                'password' => Hash::make('password'),
                'role' => 2,
            ], [
                'name' => 'admin',
                'login_id' => 'test123456',
                'password' => Hash::make('password'),
                'role' => 2,
            ]];

        DB::table('users')->insert($developer);
        DB::table('users')->insert($admin);
        factory(User::class, 500)->create();
    }
}
