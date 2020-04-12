<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return cart met waardes voor het bereken van het totaal bedrag met de functie 'getNumbers' in helper.php
        return view('layouts.cart')->with([
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        //Controleert voor duplicaten in de cart waar id het zelfde is
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        //Als duplicaat niet leeg is geef dit bericht
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Product is al in uw winkelmandje!');
        }

        //Voeg product toe met de waardes id, name en price
        Cart::add($product->id, $product->name, 1, $product->price)
            ->associate('App\Product');

        //keer terug met succes bericht als het gelukt is
        return redirect()->route('cart.index')->with('success_message', 'Product is toegevoegd aan uw winkelmandje!');
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
        //zorgt voor verplichting voor alle request dat quantity tussen 1 en 5 blijft.
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        //Als quantity niet tussen 1 en 5 is geeft error in de sessie
        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

        //contrleert of aangeven quantity beschikbaar is in productvoorraad zo niet geeft error
        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We currently do not have enough items in stock.']));
            return response()->json(['success' => false], 400);
        }

        //Als product genoeg voorraad heeft update quaantity en geeft succes message
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //verwijderd product uit cart met success message
        Cart::remove($id);

        return back()->with('success_message', 'item has been removed');
    }

    /**
     * switch to save for later .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //functie om product op te slaan voor later
    public function switchToSaveForLater($id)
    {
        //vraagt id uit cart op
        $item = Cart::get($id);
        //Verwijder product uit cart
        Cart::remove($id);

        //controlleert op duplicaten in de saveforlater
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        //Als er een duplicaat aanwezig is, geef fout melding
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already Saved For Later!');
        }

        //Voegt product toe aan saveforlater met waardes id, name, price en geeft succes message
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message', 'Item has been Saved For Later!');
    }
}
