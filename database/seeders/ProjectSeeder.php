<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ( $i=0; $i < 10; $i++ ) {
        $newProject = new Project();
        $newProject->name = $faker->sentence(3);
        $newProject->framework = $faker->sentence(2);
        $newProject->start_date = $faker->dateTimeBetween('-1 week', '+1 week');
        $newProject->description = $faker->realText($faker->numberBetween(500, 600));
        $newProject->slug = Str::slug($newProject->name,'-');
        $newProject->save();
        }
    }
}
