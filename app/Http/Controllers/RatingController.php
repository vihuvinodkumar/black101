<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Like;
use Exception;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        try {
            $checkRating = Rating::select("*")->where("product_id", $request->product_id)->get();
            if ($checkRating->count() > 0) {
                return response()->json([
                    "code" => 400,
                    "message" => "You already liked this post.",

                ])->setStatusCode(400);
            }
            $result = Rating::create($request->all());
            if ($result) {
                return response()->json([
                    "code" => 200,
                    "message" => "add rating successfully",
                    "data" => $result
                ]);
            }
            return response()->json([
                "code" => 400,
                "message" => "unable to add rating please try again",

            ])
                ->setStatusCode(400);
        } catch (Exception $e) {
            return response()->json([
                "code" => 400,
                "error" => $e
            ])
                ->setStatusCode(400);
        }
    }

    public function getAllRating()
    {
        $result = Rating::orderBy("created_at", "DESC")->get();
        if ($result) {
            return response()->json([
                "code" => 200,
                "message" => "found all rating",
                "data" => $result
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "not found"
        ])
            ->setStatusCode(400);
    }

    public function getAllRatingByProductId($product_id)
    {
        $result = Rating::select(["*"])->where("product_id", $product_id)->get();
        if ($result) {
            return response()->json([
                "message" => "found rating successfully",
                "code" => 200,
                "data" => $result
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "not found"
        ])
            ->setStatusCode(400);
    }

    public function updateRating(Request $request, $id)
    {
        $result = Rating::select(["*"])->where('id', $id)->update($request->all());
        if ($result) {
            return response()->json([
                "code" => 200,
                "messsage" => "update rating successfully",
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "id not found !"
        ])
            ->setStatusCode(400);
    }

    public function add_like(Request $request)
    {
        try {
            $auth = $this->decryptt($request->header("Authorization"));
            $check = Like::select(["*"])->where([["user_id", $auth[0]["id"]], ["post_id", $request->post_id]])->get();
            $likeData = ["post_id" => $request->post_id, "user_id" => $auth[0]["id"]];
            if (count($check) == 0) {
                $result = Like::create($likeData);
                if ($result) {
                    return response()->json([
                        "success" => true,
                        "message" => "like added"
                    ]);
                }
                return response()->json([
                    "success" => false
                ]);
            } else {
                return $this->dislike($check[0]["id"]);
                // return response()->json([
                //     "success" => false,
                //     "message" => "your like already submited"
                // ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "code" => 400,
                "error_message" => $e->getMessage()
            ])
                ->setStatusCode(400);
        }
    }

    public function dislike($id)
    {
        $result = Like::select(["*"])->where("id", $id)->delete();
        if ($result) {
            return response()->json([
                "code" => 200,
                "message" => "disliked.."
            ]);
        } else {
            return response()->json([
                "code" => 400,
                "message" => "not found !"
            ])
                ->setStatusCode(400);
        }
    }

    // public function getLikes($post_id){
    //     $result = Like::select(["*"])->where("post_id", $post_id)->get();
    //     if(count($result) > 0 ){
    //         return response()->json([
    //             "code"=>200,
    //             "message"=>"list of likes"
    //         ]);
    //     }else{
    //         return response()->json([
    //             "code"=>400,
    //             "message"=>"not found !"
    //         ])
    //         ->setStatusCode(400);
    //     }
    // }



    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }
}
