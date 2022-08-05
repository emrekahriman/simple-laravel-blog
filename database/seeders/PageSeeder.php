<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    public function run()
    {
        $page = 'Hakkımızda';
        DB::table('pages')->insert([
            'title' => $page,
            'slug' => Str::of($page)->slug('-'),
            'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius, quaerat ex et praesentium vero rem velit. Repudiandae voluptatum eum veniam quidem ea recusandae cum, expedita veritatis eaque deleniti dolor nisi!
                                    Cupiditate voluptatem recusandae distinctio maiores incidunt maxime, est atque earum necessitatibus aliquam nisi, aperiam nesciunt similique totam nemo voluptatibus ullam sapiente quis, et nostrum ipsam! Sapiente perspiciatis voluptas aliquam esse.
                                    Consequuntur quae voluptatum nihil numquam ducimus voluptates natus sed laudantium. Quam in labore ab sed, eaque laudantium pariatur dolorum, autem numquam non accusamus dolores dolore voluptate illum laborum fuga? Alias.
                                    Accusantium, reprehenderit expedita eos quo deserunt, excepturi nam aliquam voluptatibus sint illum perspiciatis neque iste nobis dolores saepe culpa hic consectetur qui sunt. Distinctio commodi animi delectus, voluptatem nihil quo.
                                    Aliquam eum deleniti sunt optio asperiores officia voluptates quidem soluta facilis doloremque, fugiat atque ipsam animi cum a sed eligendi ex quasi magnam excepturi praesentium nam possimus. Reiciendis, sapiente doloremque!
                                    Ullam possimus et facilis iste. Adipisci eaque sint porro natus eos delectus nulla quos hic dolor iure, a mollitia reiciendis doloribus rerum magnam consequatur reprehenderit facere obcaecati, repudiandae amet soluta.
                                    Velit sequi animi exercitationem debitis autem deserunt recusandae quod explicabo harum. Iure, recusandae. Error iure nobis libero, debitis, omnis similique dolores ea rerum quod, culpa hic. Odio fuga sed unde.
                                    Earum minus quasi animi, sequi quia assumenda officia. Sit nostrum earum ratione commodi autem. Minus fugit officiis, accusantium officia at illum aliquid nostrum explicabo exercitationem a expedita beatae quam molestias!
                                    Eum libero voluptatibus cumque voluptas nisi necessitatibus quod suscipit minima ea, ducimus dignissimos ad at illum officiis sapiente debitis quidem, ipsum rem repudiandae distinctio quisquam. Natus tenetur nisi ut sint.
                                    Tempore accusantium, vitae, sed doloremque reiciendis error id at odit fugiat voluptates in! Quasi commodi iste quam. Dolores amet odio fugit aperiam ratione corrupti laboriosam vitae quos, et magni quisquam.",
            'image' => "https://n9world.com/wp-content/uploads/2015/11/1200x650-ph-1.jpg",
            'order' => 1
        ]);
    }

}
