<?php

namespace App\Services;

use App\Repository\BidRepository;



class BidService{

    private BidRepository $bidRepository;

    function __construct(BidRepository $bidRepository) {
        $this->bidRepository = $bidRepository;
      }


    public function show($id)
    {
        $bids = $this->bidRepository->show($id);

        return $bids;
    }

    public function add($userId ,$auctionId ,$bidPrice)
    {


            if($this->bidRepository->add($userId ,$auctionId ,$bidPrice)) {
                return true;
              }
            else {
                return false;
              }
    }
}
