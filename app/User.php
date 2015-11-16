<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class User extends Eloquent {

    protected $collection = 'users_collection';

    protected $fillable = [
        'profiles',
        'location',
        'locality',
        'active',
        'date_registered'
    ];

    public function games()
    {
        return $this->hasMany('App\Game');
    }
}