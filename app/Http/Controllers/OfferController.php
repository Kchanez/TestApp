<?php

namespace App\Http\Controllers;

use App\traits\OfferTrait;
use App\Models\offer;
use Illuminate\Routing\Controller;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    use OfferTrait;
    public function create()
    {
        return view('AjaxOffers.create');
    }

    public function store(OfferRequest $request)
    {
       //$file_name = $this -> saveImage($request->photo, 'images/offers');
        offer::create([
            //'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'details'=> $request->details
        ]);
        return redirect()
                    ->back()
                    ->with(['success' => __('messages.saved')]);
    }
}
