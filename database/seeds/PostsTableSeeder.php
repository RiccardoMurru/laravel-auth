<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence();
            
            $newPost = new Post();
            $newPost->user_id = 1;
            $newPost->title = $title;
            $newPost->slug = Str::slug($title, '-');
            $newPost->body = $faker->text(250);
            $newPost->save();
        }
    }
}
