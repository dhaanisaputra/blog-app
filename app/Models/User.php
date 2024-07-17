<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'picture',
        'biography',
        'type',
        'blocked',
        'direct_publish'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function authorType()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }

    public function getPictureAttribute($value)
    {
        if ($value) {
            return asset('../back/dist/img/authors/' . $value);
        } else {
            return asset('../back/dist/img/authors/images.jpg');
        }
    }

    public function scopeSearch($query, $term)
    {
        // $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function communitiesposts()
    {
        return $this->hasMany(Community::class, 'author_id', 'id');
    }

    public function fotyposts()
    {
        return $this->hasMany(Foty::class, 'author_id', 'id');
    }
}
