<?php

namespace Fat\Models\User;

use Jenssegers\Mongodb\Model as Eloquent;

class User extends Eloquent {

    protected $collection = 'users';

    protected $fillable = [
        'profiles',
        'location',
        'locality',
        'active',
        'date_registered'
    ];

    public function games()
    {
        return $this->hasMany('Fat\\Models\\Game\\Game');
	}

    public function location()
    {
        return $this->embedsOne('Fat\\Models\\Location');
	}

    /**
     * @param $type string fb | fat
     * @return \Jenssegers\Mongodb\Relations\EmbedsOne
     */
    public function profile($type)
    {
        return $this->embedsOne('Fat\\Models\\User\\Profile\\FacebookProfile', 'profiles.' . $type);
	}

    /**
     * @param $sport string soccer | beachvolleyball | ...
     * @return \Jenssegers\Mongodb\Relations\EmbedsOne
     */
    public function playerProfile($sport)
    {
        return $this->embedsOne('Fat\\Models\\User\\Profile\\Player\\AbstractPlayerProfile', 'profiles.player.' . $sport);
	}

    public function follows()
    {
        return $this->belongsToMany('Fat\\Models\\User\\User', null, 'followers', 'follows');
	}

    public function followedBy()
    {
        return $this->belongsToMany('Fat\\Models\\User\\User', null, 'follows', 'followers');
	}
}