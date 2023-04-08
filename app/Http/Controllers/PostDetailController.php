<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Carbon\Carbon;
use exception;

class PostDetailController extends Controller
{
    public function getFullPostDetails(Request $request)
    {         
        try {

            $data = DB::table('story')
            ->where('created_at', '>=', Carbon::createFromDate(2023, 1, 1))
            ->orderBy("created_at", "DESC")->get();
    
            $final_data = [];
    
            for($i=0; $i < count($data); $i++){
    
                array_push($final_data, [
                    "post"=>$data[$i], 
                    "rating"=>DB::table('rating')->where('product_id', '=', $data[$i]->id)->get(),
                    "likes"=>DB::table('likes')->where('post_id','=', $data[$i]->id)->get(),
                    "my_likes"=>DB::table('likes')->where([['post_id', $data[$i]->id], ['user_id', $request->user_id]])->get()
                ]
            );
            }
            return response()->json([
                "code"=>200,
                "message"=>$final_data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "code"=>400,
                "error"=>$e->getMessage()
            ])
            ->setStatusCode(400);
        }
       

    }
}
