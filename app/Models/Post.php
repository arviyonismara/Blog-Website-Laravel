<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory, Sluggable;

    // protected $fillable = ['title', 'excerpt', 'body'];
    protected $guarded = ['id'];
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        // pencarian judul
        // if (isset($filters['search']) ? $filters['search'] : false) { // 'search' ini berdasarkan name di form search
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        // pencarian berdasarkan search
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        // query berdasarkan category
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        // query berdasarkan author
        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }

    // membuat relationship
    public function category()
    {
        // model post berelasi dengan model category
        // belongsTo berarti satu postingan berlaku satu kategori
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // eloquent sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
