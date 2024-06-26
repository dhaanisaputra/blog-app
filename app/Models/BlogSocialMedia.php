<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'bsm_instagram',
        'bsm_facebook',
        'bsm_youtube',
    ];
}
