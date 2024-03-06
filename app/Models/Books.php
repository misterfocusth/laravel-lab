<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'publisher',
        'pages',
        'rating',
        'release_date',
        'cover_image',
        'price'
    ];

    public function scopeFilter($query, array $filter)
    {
        if ($filter['title'] ?? false) {
            $query->where('title', 'like', '%' . $filter['title'] . '%');
        }

        if ($filter['author'] ?? false) {
            $query->where('author', 'like', '%' . $filter['author'] . '%');
        }

        if ($filter['publisher'] ?? false) {
            $query->where('publisher', 'like', '%' . $filter['publisher'] . '%');
        }
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
