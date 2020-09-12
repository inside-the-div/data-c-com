<?php

use Illuminate\Database\Seeder;
use App\Faq;
class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
        	$faq = new Faq;

        	$faq->user_id = 1;
        	$faq->question = "Lorem ipsum dolor amet, consectetur.?";
        	$faq->ans = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium deleniti saepe laudantium magnam quisquam. Nobis in ipsa, sed iste neque?";
        	$faq->save();
        }
    }
}
