<?php

namespace Fat\Models\User\Profile;

class FatProfile extends AbstractProfile
{

	protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'gender',
        'about',
        'media'
    ];

    public function media()
    {
        return $this->embedsMany('Fat\\Models\\Media');
	}
}