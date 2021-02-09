<?php

use Illuminate\Database\Seeder;

use App\Tag;
use App\Post;

use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        for ($i = 0; $i < 20; $i++) {
            $newTag = new Tag();

            $newTag->title = $faker->word;

            $newTag->save();
        }
    }
}
