<?php

namespace Fat\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Media extends Eloquent {

    protected $collection = 'media';

    protected $fillable = [
        'w',
        'h',
        'type',
        'data'
    ];
}