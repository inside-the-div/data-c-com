<?php

use Illuminate\Database\Seeder;
use App\Settings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$settings = new Settings;
        $settings->title = "title";
        $settings->fev_icon = "icon";
        $settings->logo = "logo";
        $settings->tag = "tag";
        $settings->email = "Test@gmail.com" ;
        $settings->phone = "+880 1XXXXXXXX";
        $settings->description = "description";
        $settings->copyright = "copyright";
        $settings->address = "address";
        $settings->location = "
            https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.034741497928!2d90.37562621544389!3d23.74614049485485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b397617379%3A0x65238a1ebd4d4222!2sDhanmondi%208%20No%20Bridge%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1596470079016!5m2!1sen!2sbd
        ";

        
        $settings->facebook = "facebook";
        $settings->youtube = "youtube";
        $settings->linkedin = "linkedin";
        $settings->instagram = "instagram";
        $settings->facebook_messenger = "facebook_messenger";

        $settings->save();
    }
}
