<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = "Nasir Khan | Owner";
        $user->email = "owner@gmail.com";
        $user->password  = Hash::make("22222222");
        $user->un_hash_password = "22222222";
        $user->type = 'admin'; // default
        $user->permissions = 'all';
        $user->permission_description = "seed created";
        $user->save();
    }
}
