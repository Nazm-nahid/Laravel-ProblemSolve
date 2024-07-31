<?php

namespace App\Repository;


use App\Models\Auction;
use App\Models\Lot;
use App\Models\Bid;


class AuctionRepository{

  public function show()
    {
        $auctions = Auction::all();

        return $auctions;
    }
  public function add($userId, $lotId, $bidPrice, $auctionDate, $duration)
  {
          $auctions = new Auction();

          $auctions->user_id = $userId;
          $auctions->lot_id = $lotId;
          $auctions->bid_price = $bidPrice;
          $auctions->auction_date = $auctionDate;
          $auctions->duration = $duration;
          $auctions->auction_status = true;

          $lot = Lot::select( "user_id" )
                      ->where( "id", "=" , $lotId)
                      ->first();

          // echo($creatorId);

          if($lot->user_id != $userId)
              return 0;

          try {
              $auctions->save();
              return 1;
            }
            catch(Exception $e) {
              return 2;
            }
  }

  public function endAuction($id, $userId)
  {
          $auctions = Auction::findOrFail($id);

          if($auctions->user_id != $userId)
              return 0;
          
          $auctions->auction_status = false;

          try {
              $auctions->save();
              return 1;
            }
            catch(Exception $e) {
              return 2;
            }
  }

  public function delete($id, $userId)
  {

          $auctions = Auction::findOrFail($id);
         
          if($auctions->user_id != $userId)
              return 0;
          
          

          if($auctions->auction_status)
              return 3;

          try {
              $auctions->delete();
              return 1;
            }
            catch(Exception $e) {
              return 2;
            }
  }
}
