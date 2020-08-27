<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(CategorySeeder::class);
        
         $this->call(ProductSeeder::class);
         $this->call(ReviewSeeder::class);
        
         $this->call(SettingsSeeder::class);
         $this->call(EcommerceSeeder::class);
         $this->call(OrderSeeder::class);
         $this->call(EmailSeeder::class);
        
    }
}
