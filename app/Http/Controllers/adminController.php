<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use App\Models\Login;
use App\Models\Rating;
use App\Models\Story;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('username');
        $password = $request->input('password');
        if ($email == 'admin@admin.com' && $password == '12345') {
            return redirect('dashboard');
        } else {
            return view('welcome')->with('error', 'Invalid email or password.');
        }
    }

    public function submitForm(Request $request)
    {
        try {
            $thumbnail = $request->file('thumbnail')->store('public/tasks/document');
            $title = $request->input('title');
            $type = $request->input('type');
            $assets = $request->input('assets');
            $headline = $request->input('headline');
            $overview = $request->input('overview');
            $publishAt = $request->input('publish_at');
            $cft = $request->input('cft');
            $story = new Story();
            $story->thumbnail = $thumbnail;
            $story->headline = $title;
            $story->type = $type;

            if ($type == 'I') {
                $story->url = $thumbnail;
            } else {
                $story->url = $assets;
            }

            $story->publish_at = $publishAt;
            $story->sub_headline = $headline;
            $story->overview = $overview;
            $story->cft = $cft;
            $story->day_of_publish = $this->getDayNumberInCurrentYear($publishAt);
            $story->save();
            $code = 200;
            $message = "Post save successfully";
            return view('addPost')->with("code", $code)->with("message", $message);
        } catch (Exception $e) {
            $message = "Error while added this post please check if all details entered is corrent and date is unique.";
            return view('addPost')->with("code", 400)->with("message", $message);
        }
    }

    function savePostEdit(Request $request, $id)
    {
        try {

            $thumbnail = "";
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('public/tasks/document');
            }
            $title = $request->input('title');
            $type = $request->input('type');
            $assets = $request->input('assets');
            $headline = $request->input('headline');
            $overview = $request->input('overview');
            $cft = $request->input('cft');

            $story = Story::find($id);
            if ($request->hasFile('thumbnail')) {
                $story->thumbnail = $thumbnail;
            }
            $story->headline = $title;
            $story->type = $type;

            if ($type == 'I') {
                $story->url = $thumbnail;
            } else {
                $story->url = $assets;
            }
            $story->sub_headline = $headline;
            $story->overview = $overview;
            $story->cft = $cft;
            $story->save();
            $code = 200;
            $message = "Post save successfully";
            return view('addPost')->with("code", $code)->with("message", $message);
        } catch (Exception $e) {
            $message = "Error while added this post please check if all details entered is corrent and date is unique.";
            return view('addPost')->with("code", 400)->with("message", $message);
        }
    }

    function editpost($id)
    {
        $story = Story::find($id);
        if ($story) {
            $code = 200;
            $message = "Edit post successfully!";
            return view('addPost', compact('story'));
        } else {
            return view("404");
        }
    }

    function getAllPost()
    {
        $posts = DB::table('story')
    ->leftJoin('rating', 'story.id', '=', 'rating.product_id')
    ->leftJoin('likes', 'story.id', '=', 'likes.post_id')
    ->select('story.*', DB::raw('IFNULL(AVG(rating.rating), 0) AS avg_rating'), DB::raw('IFNULL(COUNT(rating.rating), 0) AS total_ratings'), DB::raw('IFNULL(COUNT(likes.id), 0) AS total_likes'))
    ->groupBy('story.id')
    ->paginate(10);
        // $posts = Story::all();
        if ($posts) {
            return view('post', compact('posts'));
        } else {
            return view("404");
        }
    }

    function getDayNumberInCurrentYear($date)
    {
        // Convert input date string to Carbon instance
        $date = Carbon::parse($date);

        // Get the day number of the input date in the current year
        $dayNumber = $date->dayOfYear;

        return $dayNumber;
    }

    public function showAllUsers()
    {
        $users = Login::paginate(10);
        return view('user', compact('users'));
    }

    public function dashboard()
    {
        // last week created user---
        $lastWeek = Carbon::now()->subDays(7);
        $user = Login::whereDate('created_at', '>=', $lastWeek)->get();
        $total_user = Login::count();


        $post = Story::latest()->take(7)->get();
        $total_post = Story::count();

        // last week donation---
        $donation = Donate::whereDate('created_at', '>=', $lastWeek)->get();

        // number of donation----

        $total_donation = Donate::count();

        $total_rating = Rating::count();
        $data = ["user7days" => $user,  "donation7days" => $donation, "total_donation" => $total_donation, "total_rating" => $total_rating];
        return view("dashboard")->with("total_user", $total_user)->with("total_post", $total_post)->with("total_rating", $total_rating)->with("total_donation", $total_donation)->with("latest_post", $post);
    }

    public function getDonate(Request $request)
    {
        $donates = Donate::paginate(10);
        return view('donate', compact('donates'));
    }
}
