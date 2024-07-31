<?php


namespace App\Http\Controllers;


use Validator;

use App\Services\LotService;
use Illuminate\Http\Request;


class LotController extends Controller
{

    private LotService $lotService;

    function __construct(LotService $lotService) {
        $this->lotService = $lotService;
    }


    public function add(Request $request)
    {
        $data = $request->all();


        $rules = [
            'user_id'=>'required',
            'cultivation_type'=>'required',
            'planted_country'=>'required',
            'harvest_date'=>'required',
            'total_weight'=>'required'
        ];


        $validator = Validator::make($data , $rules );


        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }


        $userId = $data['user_id'];
        $cultivationType = $data['cultivation_type'];
        $plantedCountry = $data['planted_country'];
        $harvestDate = $data['harvest_date'];
        $totalWeight = $data['total_weight'];

        $status  = $this->lotService->add($userId, $cultivationType, $plantedCountry, $harvestDate, $totalWeight);

        if($status==1) {

            return response()->json(['error'=>['totalWeight has to be minimum 1000kg']],422);
        }

        if($status==0) {

            return response()->json(['data'=>'successfully added your lot!'],201);
        }

        return response()->json(['error'=>'$e'],400);

    }




    public function update(Request $request , $id)
    {
        $data = $request->all();


        $rules = [
            'user_id'=>'required',
            'harvest_date'=>'required'
        ];


        $validator = Validator::make($data , $rules );


        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }

        $userId = $data['user_id'];
        $harvestDate = $data['harvest_date'];

        $status  = $this->lotService->update($id, $userId, $harvestDate);

        if($status==1) {
                return response()->json(['error'=>['hey dude!! Come on!! It\'s Absence of right or claim. ']],403);
        }

        if($status==0) {
                return response()->json(['data'=>'successfully updated your lot!'],202);
        }

        return response()->json(['error'=>'$e'],400);

    }
}
