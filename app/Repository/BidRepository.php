<?php

namespace App\Repository;

use App\Models\Bid;

use DB;

class BidRepository{

    public function show($id)
    {

        // $bids = DB::select('select
        // lots.id as lot_id,lots.cultiver_type,lots.planted_country,lots.harvest_date,lots.total_weight,
        // bids.bid_price, bidder.name as  bidder_name
        // from bids
        // join lots on lots.id = bids.lot_id
        // join users bidder on bids.user_id = bidder.id
        // join users woner on woner.id = lots.user_id
        // where woner.id= ?',[$id]);

        $bids = Bid::select('lots.id as lot_id','lots.cultiver_type','lots.planted_country','lots.harvest_date',
        'lots.total_weight','bids.bid_price', 'bidder.name as  bidder_name')
        ->join('auctions', 'auctions.id','=','bids.auction_id')
        ->join('lots', 'lots.id','=','auctions.lot_id')
        ->join('users as bidder', 'bidder.id','=','bids.user_id')
        ->join('users as woner', 'woner.id','=','lots.user_id')
        ->where('woner.id', '=', $id)
        ->get();

        // $bids = DB::table("bids")
        // ->join("lots", function($join){
        //     $join->on("lots.id", "=", "bids.lot_id");
        // })
        // ->join("users as bidder", function($join){
        //     $join->on("bids.user_id", "=", "bidder.id");
        // })
        // ->join("users as woner", function($join){
        //     $join->on("woner.id", "=","lots.user_id" );
        // })
        // ->select("lots.id as lot_id", "lots.cultiver_type", "lots.planted_country", "lots.harvest_date", "lots.total_weight", "bids.bid_price", "bidder.name as bidder_name")
        // ->where("woner.id", "=", $id)
        // ->get();

        return $bids;
    }

    public function add($userId ,$auctionId ,$bidPrice)
    {
            $bids = new Bid();

            $bids->user_id = $userId;
            $bids->auction_id = $auctionId;
            $bids->bid_price = $bidPrice;

            try {
                $bids->save();
                return true;
              }
              catch(Exception $e) {
                return false;
              }
    }

}
