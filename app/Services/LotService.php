<?php

namespace App\Services;

use App\Repository\LotRepository;

class LotService{
    private LotRepository $lotRepository;

    function __construct(LotRepository $lotRepository) {
        $this->lotRepository = $lotRepository;
      }

    public function add($userId, $cultivationType, $plantedCountry, $harvestDate, $totalWeight)
      {
              if($totalWeight<1000)
              {
                return 1;
              }
              elseif($this->lotRepository->add($userId, $cultivationType, $plantedCountry, $harvestDate, $totalWeight)) {
                  return 0;
                }
              else {
                  return 2;
                }
      }




      public function update($id, $userId, $harvestDate)
      {

              return $this->lotRepository->update($id, $userId, $harvestDate);
      }
}
