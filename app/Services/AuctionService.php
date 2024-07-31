<?php

namespace App\Services;

use App\Repository\AuctionRepository;



class AuctionService{

    private AuctionRepository $auctionRepository;

    function __construct(AuctionRepository $auctionRepository) {
        $this->auctionRepository = $auctionRepository;
      }

    public function show() 
    {
        $auctions = $this->auctionRepository->show();

        return $auctions;
    }


    public function add( $userId, $lotId, $bidPrice, $auctionDate, $duration)
    {

      return ($this->auctionRepository->add($userId, $lotId, $bidPrice, $auctionDate, $duration));
    }

    public function endAuction($id, $userId)
    {
        return $this->auctionRepository->endAuction($id, $userId);
    }

    public function delete($id, $userId)
    {
        return $this->auctionRepository->delete($id, $userId);
    }
}
