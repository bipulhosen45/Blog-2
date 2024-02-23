<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 15; $i < 63 ; $i++){
            for ($j = 1; $j <= 3 ; $j++){
                $post['post_id'] = $i;
                $post['tag_id'] = random_int(17,31);
                DB::table('post_tag')->insert($post);
            }
        }
    }
}
