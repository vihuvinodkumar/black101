<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Story;
use Exception;

class StoryController extends Controller
{
    public function createStory(Request $request)
    {
        try {
            $result = Story::create($request->all());
            if ($result) {
                return response()->json([
                    "code" => 200,
                    "message" => "story created successfully",
                    "data" => $result
                ]);
            }
            return response()->json([
                "code" => 400,
                "message" => "unable to create story please try again"
            ])
                ->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => 400,
                "error" => $e
            ])
                ->setStatusCode(400);
        }
    }

    public function getAllStory()
    {
        $result = Story::orderBy("created_at", "DESC")->get();
        if ($result) {
            return response()->json([
                "code" => 200,
                "message" => "found all story",
                "data" => $result
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "not found"
        ])
            ->setStatusCode(400);
    }

    public function getStoryById(Request $request, $id)
    {
        $result = Story::select(["*"])->where("id", $id)->get();
        $auth = $this->decryptt($request->header("Authorization"));
        $like = Like::select("*")->where([["post_id", $id], ["user_id", $auth[0]["id"]]])->get();
        if (count($result) > 0) {
            return response()->json([
                "code" => 200,
                "message" => "story found successfully",
                "data" => $result,
                "like" => $like
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "not found"
        ])
            ->setStatusCode(400);
    }

    public function deleteStory($id)
    {
        $result = Story::select(["*"])->where("id", $id)->delete();
        if ($result) {
            return response()->json([
                "code" => 200,
                "message" => "story deleted successfully",
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "id not found"
        ])
            ->setStatusCode(400);
    }

    public function updateStory(Request $request, $id)
    {
        $result = Story::select(["*"])->where("id", $id)->update($request->all());
        if ($result) {
            return response()->json([
                "code" => 200,
                "message" => "story updated successfully",
                "data" => $result
            ]);
        }
        return response()->json([
            "code" => 400,
            "message" => "id not found"
        ])
            ->setStatusCode(400);
    }

    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }
}
