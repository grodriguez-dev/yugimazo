<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\PlayerRequest;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        if($request->hasFile('image')){

            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/players/';        
            $file->move($path,$img);
        }

        $arg = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $img,
        ];

        Player::create($arg);
        return redirect()->route('players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('players.form', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, Player $player)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/players/';        
            $file->move($path,$img);

            $image = public_path('/assets/players/'.$request->hiddenimage);

            if (@getimagesize($image)) {

                unlink(public_path('/assets/players/'.$request->hiddenimage));
            }

        } else {
            $img = $request->hiddenimage;
        }

        $player->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $img,
        ]);

        return redirect()->route('players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
       $player->delete();
       return redirect()->route('players.index');
    }
}
