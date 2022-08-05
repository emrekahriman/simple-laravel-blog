<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;

    public function definition()
    {
        $title = fake()->sentence();
        $images = [
            'https://miro.medium.com/max/1400/1*pwclEu7Gvke90-tVRnrX0Q.jpeg',
            'https://i0.wp.com/sistemasgeniales.com/wp-content/uploads/2020/10/REACT2-1024x683.png?resize=696%2C464',
            'https://vtiacademy.edu.vn/upload/images/django-trong-python-2.jpg',
            'https://adminlte.io/cdn-cgi/image/quality=80,format=auto,onerror=redirect,metadata=none/wp-content/uploads/2022/02/tailwindcss-templates.png',
            'https://images.viblo.asia/e1d604b1-b533-4eec-93a5-04177f28442d.jpg'
        ];

        return [
            'category_id' => rand(1, 6),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->text(500),
            'image' => $images[rand(0, 4)],
            'hit' => fake()->numerify(),
        ];
    }
}
