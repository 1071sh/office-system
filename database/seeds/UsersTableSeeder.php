<?php

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
        DB::table('users')->insert([
            [
                'name' => '管理者',
                'email' => 'super@super.com',
                'job_category' => 'エンジニア',
                'wage' => 100,
                'role' => '1',
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => '山田',
                'email' => 'yamada@test.com',
                'job_category' => 'エンジニア',
                'wage' => 30,
                'role' => '5',
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => '鈴木',
                'email' => 'suzuki@test.com',
                'job_category' => 'デザイナー',
                'wage' => 40,
                'role' => '5',
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => '田中',
                'email' => 'tanaka@test.com',
                'job_category' => 'マーケター',
                'wage' => 50,
                'role' => '5',
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
