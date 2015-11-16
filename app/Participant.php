<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Participant extends Eloquent {
    protected $fillable = [
        'id',
        'date'
    ];
}