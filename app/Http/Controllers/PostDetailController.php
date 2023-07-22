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
            $auth = $this->decryptt($request->header("Authorization"));
            $userCreatedAt = Carbon::parse($auth[0]['created_at']);
            $currentYear = Carbon::now()->year;
            $currentTime = Carbon::now();

            $data = DB::table('story')
                ->where(function ($query) use ($userCreatedAt, $currentYear, $currentTime) {
                    if ($userCreatedAt->year === $currentYear) {
                        if ($userCreatedAt->hour < 9) {
                            // Show posts created at or after user's creation date
                            $query->where('created_at', '>=', $userCreatedAt);
                        } else {
                            // Hide posts created before user's creation date and show posts created after user's creation date + 1 day
                            $query->whereDate('created_at', '>', $userCreatedAt->addDay());
                        }
                    } else {
                        // Show posts from the current year
                        $query->whereYear('created_at', $currentYear);
                    }
                })
                ->orderBy("created_at", "DESC")->get();

            $final_data = [];

            foreach ($data as $post) {
                $postID = $post->id;
                $postLikes = DB::table('likes')->where('post_id', $postID)->get();
                $postRatings = DB::table('rating')->where('product_id', $postID)->get();
                $myLikes = DB::table('likes')->where([['post_id', $postID], ['user_id', $auth[0]["id"]]])->get();

                array_push(
                    $final_data,
                    [
                        "post" => $post,
                        "rating" => $postRatings,
                        "likes" => $postLikes,
                        "my_likes" => $myLikes
                    ]
                );
            }

            return response()->json([
                "code" => 200,
                "data" => $final_data,
                "created_at" => $userCreatedAt->hour
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "code" => 400,
                "error" => $e->getMessage()
            ])->setStatusCode(400);
        }
    }
    
    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }
}
