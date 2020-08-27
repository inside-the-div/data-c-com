<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $name = [
            'Nasir',
            'Kamrul',
            'Mim',
            'Sakib',
            'Noman',
            'Arafat',
            'Imam',
            'Sumon',
            'Jabed',
            'Mamun'
        ];

        for($i=0;$i<10;$i++){
            $user = new User;

            $user->name = $name[$i]." | Customer-".($i+1);
            $user->email = "customer".($i+1)."@gmail.com";
            $user->password  = Hash::make("22222222");
            $user->un_hash_password = "22222222";
            $user->type = 'customer'; // default

            $user->phone = "0163701796".$i;
            $user->save();
        }







    }
}
