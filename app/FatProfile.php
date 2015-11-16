<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class FatProfile extends Profile {

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'gender',
        'about',
        'media'
    ];

    public function media()
    {
        return $this->embedsMany('App\Media');
    }
}