<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([[
            'title' => 'First post',
            'body' => 'First words are amazing because. And much more awesome words in it you should know how amaazing these words is!',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'recipe_image' => 'noimage.jpg',
            'user_id' => 1

        ],[
            'title' => 'Second post',
            'body' => 'Second words are amazing because. And much more awesome words in it you should know how amaazing these words is!',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'recipe_image' => 'noimage.jpg',
            'user_id' => 2
        ],[
            'title' => 'third post',
            'body' => 'third words are amazing because. And much more awesome words in it you should know how amaazing these words is!',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'recipe_image' => 'noimage.jpg',
            'user_id' => 3
            ]]);

    }
}
