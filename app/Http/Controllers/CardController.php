<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\CardRequest;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cards.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardRequest $request)
    {
        if($request->hasFile('image')){

            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/cards/';        
            $file->move($path,$img);
        }

        $arg = [
            'name' => $request->name,
            'skill' => $request->skill,
            'type' => $request->type,
            'atk' => $request->atk,
            'def' => $request->def,
            'image' => $img,
        ];

        Card::create($arg);
        return redirect()->route('cards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('cards.form', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(CardRequest $request, Card $card)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/cards/';        
            $file->move($path,$img);

            $image = public_path('/assets/cards/'.$request->hiddenimage);

            if (@getimagesize($image)) {

                unlink(public_path('/assets/cards/'.$request->hiddenimage));
            }

        } else {
            $img = $request->hiddenimage;
        }

        $card->update([
            'name' => $request->name,
            'skill' => $request->skill,
            'type' => $request->type,
            'atk' => $request->atk,
            'def' => $request->def,
            'image' => $img,
        ]);

        return redirect()->route('cards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('cards.index');
    }
}
