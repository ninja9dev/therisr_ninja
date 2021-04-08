<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // adding default app_name & Admin email id
        $default_settings = array(
                "app_name" => 'TheRisr',
                "email" => 'admin@gmail.com',
                "currency" => '$',
                "currency_code" => 'USD',
                "service_fee" => '2.9',
                "per_page_data" => 6,
                "frontsite_link" => 'https://www.therisr.com/',
                "cookie_link"  => '',
                "privacy_link" => 'https://www.therisr.com/privacy-policy',
                "term_link"    => 'https://www.therisr.com/tos',
                "help_link"    => 'https://www.therisr.com/#email-form',
                "insta_link" => 'https://www.instagram.com/the_risr_freelanceinstartup/',
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
        );
        App\Models\Settings::create($default_settings);
    }
}
