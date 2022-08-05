<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id')->whereStatus(1)->orderBy('created_at', 'DESC');
    }

    // Status değeri 0 olan ve cop kutusuna tasinan article'lari da getirir
    public function articlesWithDisable()
    {
        return $this->hasMany(Article::class, 'category_id', 'id')->withTrashed()->orderBy('created_at', 'DESC');
    }
}
