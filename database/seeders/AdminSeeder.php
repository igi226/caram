<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'user1 Camaria',
                'slug' => 'user1-Camaria',
                'phone' => '+1 1237894560',
                'email' => 'usercamaria1@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user2 Camaria',
                'slug' => 'user12-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria2@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user2 Camaria',
                'slug' => 'user13-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria3@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user4 Camaria',
                'slug' => 'user14-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria4@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user5 Camaria',
                'slug' => 'user15-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria5@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user6 Camaria',
                'slug' => 'user16-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria6@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user7 Camaria',
                'slug' => 'user17-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria7@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user8 Camaria',
                'slug' => 'user18-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria8@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user9 Camaria',
                'slug' => 'user9-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria9@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user10 Camaria',
                'slug' => 'user10-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria10@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user11 Camaria',
                'slug' => 'user11-Camaria',
                
                'phone' => '+1 1237894560',
                'email' => 'usercamaria11@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user22 Camaria',
                'slug' => 'user12-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria22@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user33 Camaria',
                'slug' => 'user13-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria33@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'user44 Camaria',
                'slug' => 'user14-Camaria',

                'phone' => '+1 1237894560',
                'email' => 'usercamaria44@mail.com',
                'password' => Hash::make('usercamaria123'),
                'role' => 'user',
                'status' => '1',
            ]
        ];

        
            DB::table('users')->insert($data);
        
    }
}
