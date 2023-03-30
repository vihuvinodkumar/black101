<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Exception;

class StoryController extends Controller
{
    public function createStory(Request $request)
    {
        try {
            $result = Story::create($request->all());
            if($result){
                return response()->json([
                    "code"=>200,
                    "message"=>"story created successfully",
                    "data"=>$result
                ]);
            }
            return response()->json([
                "code"=>400,
                "message"=>"unable to create story please try again"
            ])
            ->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json([
                "code"=>400,
                "error"=>$e
            ])
            ->setStatusCode(400);
        }
    }

    public function getAllStory()
    {
        $result = Story::orderBy("created_at", "DESC")->get();
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"found all story",
                "data"=> $result
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"not found"
        ])
        ->setStatusCode(400);
    }

    public function getStoryById($id)
    {
        $result = Story::select(["*"])->where("id",$id)->get();
        if(count($result) > 0 ){
            return response()->json([
                "code"=>200,
                "message"=>"story found successfully",
                "data"=>$result
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"not found"
        ])
        ->setStatusCode(400);
    }

    public function deleteStory($id)
    {
        $result = Story::select(["*"])->where("id",$id)->delete();
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"story deleted successfully",
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"id not found"
        ])
        ->setStatusCode(400);
    }

    public function updateStory(Request $request, $id)
    {
        $result = Story::select(["*"])->where("id", $id)->update($request->all());
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"story updated successfully",
                "data"=> $result
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"id not found"
        ])
        ->setStatusCode(400);
    }

}
