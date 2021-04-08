<?php

use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Skills::insert(array(
        	['name' => 'PHP'],
        	['name' => 'Wordpress'],
        	['name' => 'HTML'],
        	['name' => 'CSS'],
        	['name' => 'SEO'],
        	['name' => 'SMO'],
        	['name' => 'Laravel'],
        	['name' => 'Python'],
        	['name' => 'Angular'],
        	['name' => 'ReactJS'],
        	['name' => 'Node'],
        	['name' => 'MongoDB'],
        	['name' => 'JavaScript'],
        	['name' => 'jQuery']
        ));
    }
}
