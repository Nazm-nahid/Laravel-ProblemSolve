<?php

namespace App\Http\Controllers;

use App\Services\AuctionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Validator;

class AuctionController extends Controller
{
    private AuctionService $auctionService;

    function __construct(AuctionService $auctionService) {
        $this->auctionService = $auctionService;
    }


    public function show() : JsonResponse
    {
        $auctions = $this->auctionService->show();

        return response()->json(['auctions'=>$auctions],200);
    }
    

    public function add(Request $request) : JsonResponse
    {
        $data = $request->all();


        $rules = [
        'user_id'=>'required',
        'lot_id'=>'required',
        'bid_price'=>'required',
        'auction_date'=>'required',
        'duration'=>'required'
        ];

        $validator = Validator::make($data , $rules);


        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }


        $userId = $data['user_id'];
        $lotId = $data['lot_id'];
        $bidPrice = $data['bid_price'];
        $auctionDate = $data['auction_date'];
        $duration = $data['duration'];

        $status = $this->auctionService->add($userId, $lotId, $bidPrice, $auctionDate,
        $duration);

        if($status == 1) {

            return response()->json(['data'=>'successfully added your auction!'],201);
        }

        if($status==0) {

            return response()->json(['error'=>['hey dude!! Come on!! It\'s Absence of right or claim. ']],401);
        }

        return response()->json(['error'=>'error'],400);


    }

    public function endAuction(Request $request, $id) : JsonResponse
    {
        $data = $request->all();

        $rules = [
        'user_id'=>'required'
        ];

        $validator = Validator::make($data , $rules /*, $customMessage*/);


        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()],422);
        }

        $userId = $data['user_id'];

        $status = $this->auctionService->endAuction($id, $userId);

        if($status==1) {

            return response()->json(['data'=>'successfully end your auction!'],201);
        }

        if($status==0) {

            return response()->json(['error'=>['hey dude!! Come on!! It\'s Absence of right or claim. ']],401);
        }


        return response()->json(['error'=>'error'],400);

    }


    public function delete(Request $request, $id) : JsonResponse
    {
        $data = $request->all();

        $rules = [
        'user_id'=>'required'
        ];

        $validator = Validator::make($data , $rules /*, $customMessage*/);


        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()],422);
        }

        $userId = $data['user_id'];

        $status = $this->auctionService->delete($id, $userId);

        

        if($status==1) {

            return response()->json(['data'=>'successfully removed your auction!'],201);
        }

        if($status==0) {

            return response()->json(['error'=>['hey dude!! Come on!! It\'s Absence of right or claim. ']],401);
        }

        if($status==3) {

            return response()->json(['error'=>['hey dude!! End the auctions.']],401);
        }


        return response()->json(['error'=>'error'],400);

    }


}
