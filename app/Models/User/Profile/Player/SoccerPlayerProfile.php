<?php

namespace Fat\Models\User\Profile\Player;

class SoccerPlayerProfile extends AbstractPlayerProfile
{
	protected $fillable = [
        'position',
        'since',
    ];
}