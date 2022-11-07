<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Notifications\OfferAccepted;
use App\Notifications\OfferRejected;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        // Load relations
        // $offer->load(['listing', 'listing.offers']);

        // Accept selected offer
        $offer->update(['accepted_at' => now()]);
        // $offer->accepted_at = now();
        // $offer->save();

        // Add offer sold date
        // $offer->for->sold_at = now();
        // $offer->for->save();

        // Reject all other offers
        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);
        // Offer::where('for_id', $offer->for_id)
        //     ->where('id', '!=', $offer->id)
        //     ->update([
        //         'rejected_at' => now()
        //     ]);

        // Notify users about rejection
        $offer->listing
            ->offers()
            ->notByMe()
            ->with('bidder')
            ->get()
            ->each(
                fn (Offer $offer) => $offer->bidder->notify(new OfferRejected($offer))
            );
        // Notify the bidder his offer was accepted
        $offer->bidder->notify(new OfferAccepted($offer));

        // $offer->for
        // ->offers
        // ->filter(fn (Offer $o) => $o->id !== $offer->id)
        // ->each(fn (Offer $o) => $o->by->notify(new OfferRejected($o)));

        return redirect()->back()->with(
            'success',
            "Offer #{$offer->id} accepted, other offers rejected"
        );
    }
}
