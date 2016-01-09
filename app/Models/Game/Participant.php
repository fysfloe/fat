<?php

namespace Fat\Models\Game;

use Jenssegers\Mongodb\Model as Eloquent;

class Participant extends Eloquent {
    protected $fillable = [
        'id',
        'date'
    ];
}