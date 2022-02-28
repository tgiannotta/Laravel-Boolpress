<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['carne', 'pesce', 'vegetariano', 'piatto Veloce'];
        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name =$tag;
            $new_tag->slug = Str::slug($tag); 
            $new_tag->save();
        }
    }
}
