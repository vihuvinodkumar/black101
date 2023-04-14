<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Story;
use Carbon\Carbon;
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

    public function getPostByUserId(Request $request){

        $auth = $this->decryptt($request->header("Authorization"));


        // $user_created_day = $auth[0]->created_at->day;
        // $current_year = Carbon::now()->year;

        // $stories = DB::table('story')
        //     ->whereRaw('DAY(story.created_at) > ?', [$user_created_day])
        //     ->whereRaw('YEAR(story.created_at) = ?', [$current_year])
        //     ->get();

        // return response()->json(['data' => $stories]);

        $user_created_at_day = $auth[0]['created_at']->day;
        $current_year = date('Y');
        
        $stories = Story::whereDay('created_at', '>=', $user_created_at_day)
                        ->whereYear('created_at', $current_year)
                        ->get();
                        
        return response()->json($stories);
        
        return $post;
    }

    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }
}
