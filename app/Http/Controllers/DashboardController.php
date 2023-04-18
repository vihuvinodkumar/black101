<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Login;
use App\Models\Story;
use App\Models\Donate;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        try {
             // last week created user---
        $lastWeek = Carbon::now()->subDays(7);
        $user = Login::whereDate('created_at', '>=', $lastWeek)->get();

        // today post/stroy---- 
        $today = Carbon::today();
        $post = Story::whereDate('created_at', $today)->get();

        // last week donation---
        $donation = Donate::whereDate('created_at', '>=', $lastWeek)->get();


        // number of donation----

        $total_donation = Donate::count();

        return response()->json([
            "code"=>200,
            "last7days_user"=>$user,
            "today_post"=>$post,
            "last7donation"=>$donation,
            "total_donation"=>$total_donation

        ]);

        } catch (\Exception $e) {
            return response()->json([
                "code"=>400,
                "error_message"=>$e->getMessage()
            ])
            ->setStatusCode(400);
        }
       
    }
}
