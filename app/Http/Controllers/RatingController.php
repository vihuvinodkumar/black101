<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Exception;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        try {
            $result = Rating::create($request->all());
            if($result){
                return response()->json([
                    "code"=>200,
                    "message"=>"add rating successfully",
                    "data"=>$result
                ]);
            }
            return response()->json([
                "code"=>400,
                "message"=>"unable to add rating please try again",

            ])
            ->setStatusCode(400);

        } catch (\Exception $e) {
            return response()->json([
                "code"=>400,
                "error"=>$e
            ])
            ->setStatusCode(400);
        }
    }

    public function getAllRating()
    {
        $result = Rating::orderBy("created_at", "DESC")->get();
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"found all rating",
                "data"=>$result
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"not found"
        ])
        ->setStatusCode(400);
    }

    public function getAllRatingByProductId($product_id)
    {
        $result = Rating::select(["*"])->where("product_id", $product_id)->get();
        if($result){
            return response()->json([
                "message"=>"found rating successfully",
                "code"=>200,
                "data"=>$result
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"not found"
        ])
        ->setStatusCode(400);
    }

    public function updateRating(Request $request, $id)
    {
        $result = Rating::select(["*"])->where('id', $id)->update($request->all());
        if($result){
            return response()->json([
                "code"=>200,
                "messsage"=>"update rating successfully",
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"id not found !"
        ])
        ->setStatusCode(400);
    }
}
