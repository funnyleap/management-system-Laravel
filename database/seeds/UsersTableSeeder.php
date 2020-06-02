<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'テスト',
            'login_id' => 'test1234',
            'password' => Hash::make('password'),
        ];

        DB::table('users')->insert($param);
        factory(User::class, 50)->create();
    }
}

