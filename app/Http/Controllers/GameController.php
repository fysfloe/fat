<?php

namespace Fat\Http\Controllers;

use Illuminate\Http\Request;

use Fat\Models\Game\Game;
use Fat\Models\Location;
use Fat\Models\User\User;
use Fat\Models\Media;

class GameController extends AbstractController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizer = User::all()->first();

        $location = new Location(array(
            'lat' => '237935.2357035',
            'lng' => '235703750.235703570'
        ));

        $media = new Media(array(
            'w' => 800,
            'h' => 600,
            'type' => 'image/jpeg',
        ));

        Game::create(
            array(
                'organizer' => $organizer->id,
                'date_listed' => time(),
                'date_start' => strtotime('+24h'),
                'duration' => 90,
                'locality' => '1140 Wien',
                'location' => $location->attributesToArray(),
                'facilities_std' => [
                    'sh', 'outd', 'gr'
                ],
                'facilities_add' => 'foo',
                'title' => 'se first game',
                'headline' => 'is a good game',
                'description' => 'yes',
                'media' => $media->attributesToArray(),
                'costs' => [
                    'total' => 7000,
                    'currency' => 'EUR',
                ],
                'mode' => '7vs7',
                'players' => [
                    'min' => 2,
                    'max' => 10,
                ],
                'level' => 'pro',
                'equipment' => [
                    'cleats',
                ],
                'shirts' => [
                    'colors' => ['black', 'white'],
                    'provided' => false,
                ],
                'confirmation' => false,
                'sport' => 'soccer',
            )
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
        //
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

    public function addParticipant($id)
    {

    }
}
