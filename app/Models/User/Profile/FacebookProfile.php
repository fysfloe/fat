<?php

namespace Fat\Models\User\Profile;

class FacebookProfile extends AbstractProfile
{

	protected $fillable = [
        'fb_id',
        'firstname',
        'lastname',
        'email',
        'media'
    ];

    public function media()
    {
        return $this->embedsMany('Fat\\Models\\Media');
	}
}