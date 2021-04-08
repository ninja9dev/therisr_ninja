<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        App\Models\Services::insert(array(
        	['name' => 'UI/UX Design'],
        	['name' => 'Web Design'],
        	['name' => 'Photo Editing'],
        	['name' => 'App Design'],
        	['name' => 'Social Media Marketing'],
        	['name' => 'User Experience'],
        	['name' => 'User Experience Design'],
        	['name' => 'Universal Design'],
        	['name' => 'User Interface'],
        	['name' => 'User Interaction'],
        	['name' => 'Wordpress'],
        	['name' => 'Web Development'],
        	['name' => 'Software Development']
        ));
    }
}
