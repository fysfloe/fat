<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class FacebookProfile extends Profile {

    protected $fillable = [
        'fb_id',
        'firstname',
        'lastname',
        'email',
        'media'
    ];

    public function media()
    {
        return $this->embedsMany('App\Media');
    }
}