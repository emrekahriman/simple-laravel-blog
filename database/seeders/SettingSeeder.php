<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'Blog Projesi | EK',
            'logo' => 'uploads/logo.png',
            'favicon' => 'uploads/favicon.png',
            'description' => 'description',
            'keywords' => 'keyword',
            'author' => 'author',
        ]);
    }
}
