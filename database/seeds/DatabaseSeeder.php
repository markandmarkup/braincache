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
        factory(App\User::class, 10)->create()->each(function ($user) {
            $posts = factory(App\Post::class, 3)->make();
            $user->posts()->saveMany($posts);
        });

        factory(App\Tag::class, 15)->create();
    }
}
