<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_name',
        'blog_email',
        'blog_description',
        'blog_logo',
        'blog_favicon',
    ];

    static public function getSingle()
    {
        return self::find(1);
    }

    public function getLogo()
    {
        if (!empty($this->blog_logo) && file_exists('../back/dist/img/logo-favicon/' . $this->blog_logo)) {
            return url('/back/dist/img/logo-favicon/' . $this->blog_logo);
        } else {
            return '';
        }
    }

    public function getFavicon()
    {
        // if (file_exists(asset('../back/dist/img/logo-favicon/' . $this->blog_favicon))) {
        //     return url('/back/dist/img/logo-favicon/' . $this->blog_favicon);
        // }
        if (!empty($this->blog_favicon) && file_exists('/back/dist/img/logo-favicon/' . $this->blog_favicon)) {
            return url('/back/dist/img/logo-favicon/' . $this->blog_favicon);
        } else {
            return '';
        }
    }
}
