<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Location extends Eloquent {
    protected $fillable = [
        'lat',
        'lng'
    ];
}