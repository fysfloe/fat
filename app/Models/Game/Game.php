<?php

namespace Fat\Models\Game;

use Jenssegers\Mongodb\Model as Eloquent;

class Game extends Eloquent {

    protected $collection = 'games';

    protected $fillable = [
        'organizer',
        'date_listed',
        'date_start',
        'duration',
        'locality',
        'location',
        'facilities_std',
        'facilities_add',
        'title',
        'headline',
        'description',
        'media',
        'costs',
        'mode',
        'players',
        'level',
        'equipment',
        'shirts',
        'confirmation',
        'participants',
        'sport'
    ];

    public function participants()
    {
        return $this->embedsMany('Fat\\Models\\Game\\Participant');
	}

    public function organizer()
    {
        return $this->hasOne('Fat\\Models\\User\\User');
	}

    public function media()
    {
        return $this->embedsMany('Fat\\Models\\Media');
	}

    public function location()
    {
        return $this->embedsOne('Fat\\Models\\Location');
	}
}