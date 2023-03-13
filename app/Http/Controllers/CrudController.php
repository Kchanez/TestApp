<?php

namespace App\Http\Controllers;

use App\Models\offer;
use App\Models\Video;
use App\traits\OfferTrait;
use App\Events\VideoViewer;
use Illuminate\Routing\Controller;
use App\Http\Requests\OfferRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CrudController extends Controller
{
    use OfferTrait;
    public function create()
    {
        return view(view:'offers.create');
    }

    public function store(OfferRequest $request)
    {
        $file_name = $this -> saveImage($request->photo, 'images/offers');
        offer::create([
            'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'details'=> $request->details
        ]);
        return redirect()
                    ->back()
                    ->with(['success' => __('messages.saved')]);
    }

   public function getAllOffers()
   {
        $offers = offer::select('id','name','price','details')->get();
        //$offers = offer::all();
            return View('offers.all',['offers' => $offers ]);
   }

   public function editOffer($offer_id)
   {
        $req = offer::find($offer_id);
        if($req)
        {
            $offer = offer::select('id','name', 'price', 'details') ->find($offer_id);
            return view('offers.edit',compact('offer'));
        }
        else
        {
            return "id doesn't exist";
        }
   }


   public function deleteOffer($offer_id)
   {
        $req = offer::find($offer_id);
        if(!$req)
            //$deleted = DB::delete('delete from offers');
            return redirect()
                        ->back()
                        ->with(['error' =>  __('messages.your offer doesn\'t exist')]);
            $req->delete();
            return redirect()
                        ->back()
                        ->with(['success' => __('messages.delete')]);
   }




   public function updateOffer(OfferRequest $request , $offer_id)
   {

        //$this -> saveImage($request->photo, 'images/offers');
        $offer = offer::find($offer_id);
        $offer -> update($request->all());
        /* $offer->update([
            'name' => $request->name,
            'price' => $request->price,
            'details'=> $request->details
        ]); */
        return redirect()->back()->with(['success' => 'your offer has been successfully modified']);
   }

   public function getVideo()
   {
        $video = Video::first();
        event(new VideoViewer($video));
            return view('youtube') -> with(['video' => $video]);
   }
}
