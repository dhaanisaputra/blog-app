<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foty extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'name_foty',
        'post_slug',
        'post_content',
        'year_foty',
        'featured_image',
        'status_foty',
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
                'source' => 'name_foty'
            ]
        ];
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name_foty', 'like', $term);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
