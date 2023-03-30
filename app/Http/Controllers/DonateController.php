<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\Donate;
use Exception;
use Carbon\Carbon;

class DonateController extends Controller
{
    public function createDonate(Request $request)
    {
       try {
        $datetime = Carbon::now()->format('Y-m-d H:i:s');
        $request['donated_at'] = $datetime;
        $donate = Donate::create($request->all());
        if($donate){
            return response()->json([
                "message"=>"donate created sucessfully",
                "code"=>200,
                "data"=>$donate
            ]);
        }
        return response()->json([
            "message"=>"unable to create donate, please try again",
            "code"=>400
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

    public function getAllDonate()
    {
        $donate = Donate::orderBy("created_at", "DESC")->get();
        if($donate){
            return response()->json([
                "code"=>200,
                "message"=>"list of donate",
                "data"=>$donate
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"not found"
        ])
        ->setStatusCode(400);
    }

    public function getDonateById($id)
    {
        $result = DB::select("SELECT * FROM `donate` d INNER JOIN `user` u ON u.id = d.user_id WHERE d.id=$id");
        if(count($result) > 0){
            return response()->json([
                "code"=>200,
                "message"=>"found donate successfully",
                "data"=>$result
            ]);
        }
        return response()->json([
            "message"=>"not found",
            "code"=>400
        ])
        ->setStatusCode(400);
    }

    public function deleteDonate($id)
    {
        $result = Donate::select(["*"])->where('id',$id)->delete();
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"data deleted successfully"
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"id not found"
        ])
        ->setStatusCode(400);
    }

    public function updateDonate(Request $request, $id)
    {
        $datetime = Carbon::now()->format('Y-m-d H:i:s');
        $request['donated_at'] = $datetime;
        $result = Donate::select(["*"])->where('id', $id)->update($request->all());
        if($result){
            return response()->json([
                "code"=>200,
                "message"=>"updated successfully"
            ]);
        }
        return response()->json([
            "code"=>400,
            "message"=>"id not found"
        ])
        ->setStatusCode(400);
    }
    
}
