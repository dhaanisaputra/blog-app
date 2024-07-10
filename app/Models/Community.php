<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Community extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'author_id',
        'category_id',
        'post_title',
        'post_slug',
        'post_content',
        'featured_image',
        'status_community',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => 'communities_title'
            ]
        ];
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('communities_title', 'like', $term);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
