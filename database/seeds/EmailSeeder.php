<?php

use Illuminate\Database\Seeder;
use App\Email;
class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
        	$e = new Email;

        	$e->name = "user-".$i;
        	$e->email = "user-".$i."@gmail.com";
        	$e->phone = "016370192".$i;
        	$e->subject = "Subject-".$i;
        	$e->message = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur error soluta quae, expedita, molestias, rerum nihil optio recusandae doloribus maxime libero commodi facilis eveniet? Ullam illum laborum voluptatem, ea laboriosam assumenda, consequuntur facere animi sunt molestias deleniti eveniet expedita. Quos ipsum maxime, quisquam, dolor nulla doloremque ad suscipit impedit quidem voluptate commodi voluptatum consequuntur facilis, dolore id optio itaque culpa et tempore eligendi molestiae rerum dolores eaque harum possimus. Molestias modi labore assumenda tempora totam aliquam delectus harum atque, quae, perspiciatis reprehenderit eligendi dignissimos pariatur, est odit ut animi itaque consequuntur impedit sit! Unde, omnis, fugiat. Facere eius eligendi quidem!";

        	$e->save();

        }
    }
}
