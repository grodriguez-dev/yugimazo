<?php

namespace App\Http\Controllers;

use App\Models\Mazo;
use App\Models\Player;
use App\Models\Card;
use Illuminate\Http\Request;

class MazoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        $mazos = Mazo::with('player', 'cards')->get();
        return view('mazos.index', compact('players', 'mazos'));
    }

    /**
     * Show the form for view the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verCard(Request $request)
    {
        $title = $request->title;
        $player_id = $request->player_id;
        $cards = Card::all();
        $value = 0;
        return view('verCards', compact('cards', 'value', 'title', 'player_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mazo  $mazo
     * @return \Illuminate\Http\Response
     */
    public function savedCard(Request $request)
    {   
        $arg = [
            'title' => $request->title,
            'player_id' => $request->player_id,
        ];

        $mazo = Mazo::create($arg);

        foreach($request->check_id as $cardId){
            $arg1 = [
                'mazo_id' => $mazo->id,
            ];
            Card::where('id', $cardId)->update($arg1);
        }
        
        return redirect()->route('mazos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mazo  $mazo
     * @return \Illuminate\Http\Response
     */
    public function card($id)
    {
        $cards = Card::where('mazo_id', $id)->get();
        return view('cardsMazo', compact('cards'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mazo  $mazo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mazo $mazo)
    {
        $mazo->delete();
         return redirect()->route('mazos.index');
    }
}
