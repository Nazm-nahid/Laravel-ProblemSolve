<?php

namespace App\Http\Controllers;

use Validator;

use App\Services\BidService;
use Illuminate\Http\Request;



class BidController extends Controller
{
    private BidService $bidService;

    function __construct(BidService $bidService) {
        $this->bidService = $bidService;
    }



    public function show($id)
    {
        $bids = $this->bidService->show($id);

        return response()->json(['bids'=>$bids],200);
    }

    public function add(Request $request)
    {
        $data = $request->all();


        $rules = [
        'user_id'=>'required',
        'auction_id'=>'required',
        'bid_price'=>'required'
        ];


        $validator = Validator::make($data , $rules  );


        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }


        $userId = $data['user_id'];
        $auctionId = $data['auction_id'];
        $bidPrice = $data['bid_price'];

        if($this->bidService->add($userId ,$auctionId ,$bidPrice)) {

            return response()->json(['data'=>'successfully added your bid!'],201);
        }

        return response()->json(['error'=>'error'],400);
    }
}
