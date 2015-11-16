<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Media;
use App\Location;
use App\FatProfile;
use App\SoccerPlayerProfile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        foreach($users as $user)
        {
            var_dump($user->profiles['fat']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = new Media([
            'w' => 1280,
            'h' => 720,
            'type' => 'image/png',
        ]);

        $location = new Location([
            'lat' => '2356935.35693569',
            'lng' => '12359691.123993469',
        ]);

        $fat_profile = new FatProfile([
            'firstname' => 'Florian',
            'lastname' => 'Csizmazia',
            'email' => 'florian.csizmazia@gmail.com',
            'gender' => 'm',
            'about' => 'se best person',
            'media' => $media->attributesToArray(),
        ]);

        $soccer_player_profile = new SoccerPlayerProfile([
            'position' => 'forward',
            'since' => strtotime('-24h'),
        ]);

        User::create(
            [
                'profiles' => [
                    'fat' => $fat_profile->attributesToArray(),
                    'player' => [
                        'soccer' => $soccer_player_profile->attributesToArray(),
                    ]
                ],
                'location' => $location->attributesToArray(),
                'locality' => '1140 Wien',
                'active' => true,
                'date_registered' => time()
            ]
        );
        echo 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow($id)
    {
        $follower = User::all()->first();
        $followed_user = User::all()->find($id);
        $followed_user->followedBy()->attach($follower->id);

        echo 'follow';
    }
}
