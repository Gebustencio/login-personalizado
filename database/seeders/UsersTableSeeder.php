<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name="German Bustencio";
        $user->email ="bus@bus";
        $user->password="$2y$10$7eWdaUvLZfsNzLFfc2CMj.iYfanPtug.p2w0omq3H0SP1IwcTVQmq";
        // 12345678
        $user->ci="6154127";
        $user->address="sin direccion";
        $user->phone="73279638";
        $user->role="admin";
        $user->save();


        $user1= new User();
        $user1->name="Jahnet";
        $user1->email ="jhane@jhane";
        $user1->password="$2y$10$7eWdaUvLZfsNzLFfc2CMj.iYfanPtug.p2w0omq3H0SP1IwcTVQmq";
        // 12345678
        $user1->ci="6154127";
        $user1->address="sin direccion";
        $user1->phone="73279638";
        $user1->role="doctor";
        $user1->save();

        $user2= new User();
        $user2->name="Miguel Angel";
        $user2->email ="micy@micky";
        $user2->password="$2y$10$7eWdaUvLZfsNzLFfc2CMj.iYfanPtug.p2w0omq3H0SP1IwcTVQmq";
        // 12345678
        $user2->ci="6154127";
        $user2->address="sin direccion";
        $user2->phone="73279638";
        $user2->role="patient";
        $user2->save();

        //User::factory(50)->create();

    }
}
