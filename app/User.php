<?php

namespace App;

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
        return $this->hasMany('App\Game');
    }

    public function location()
    {
        return $this->embedsOne('App\Location');
    }

    /**
     * @param $type string fb | fat
     * @return \Jenssegers\Mongodb\Relations\EmbedsOne
     */
    public function profile($type)
    {
        return $this->embedsOne('App\FacebookProfile', 'profiles.'.$type);
    }

    /**
     * @param $sport string soccer | beachvolleyball | ...
     * @return \Jenssegers\Mongodb\Relations\EmbedsOne
     */
    public function playerProfile($sport)
    {
        return $this->embedsOne('App\PlayerProfile', 'profiles.player.'.$sport);
    }

    public function follows()
    {
        return $this->belongsToMany('App\User', null, 'followers', 'follows');
    }

    public function followedBy()
    {
        return $this->belongsToMany('App\User', null, 'follows', 'followers');
    }
}