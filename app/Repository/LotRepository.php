<?php

namespace App\Repository;

use App\Models\Lot;

class LotRepository{
    public function add($userId, $cultivationType, $plantedCountry, $harvestDate, $totalWeight)
   {

           $lots = new Lot();

           $lots->user_id = $userId;
           $lots->cultiver_type = $cultivationType;
           $lots->planted_country = $plantedCountry;
           $lots->harvest_date = $harvestDate;
           $lots->total_weight = $totalWeight;

           try {
               $lots->save();
               return true;
             }
             catch(Exception $e) {
               return false;
             }
   }




   public function update($id, $userId, $harvestDate)
   {

           $lots = Lot::findOrFail($id);

           if($lots->user_id != $userId)
           {
            return 1;
           }

           $lots->harvest_date = $harvestDate;

           try {
               $lots->save();
               return 0;
             }
             catch(Exception $e) {
               return 2;
             }
   }
}
