<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Story;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class adminController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('username');
        $password = $request->input('password');
        if ($email == 'admin@admin.com' && $password == '12345') {
            return view('dashboard');
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
            $story->url = $assets;
            $story->publish_at = $publishAt;
            $story->sub_headline = $headline;
            $story->overview = $overview;
            $story->cft = $cft;
            $story->day_of_publish = $this->getDayNumberInCurrentYear($publishAt);
            $story->save();
            return view("dashboard");
        } catch (Exception $e) {
            return view("addPost");
        }
    }

    function savePostEdit(Request $request, $id)
    {
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
        $story->url = $assets;
        $story->sub_headline = $headline;
        $story->overview = $overview;
        $story->cft = $cft;
        $story->save();
        return redirect()->route('allpost');;
    }

    function editpost($id)
    {
        $story = Story::find($id);
        if ($story) {
            return view('addpost', compact('story'));
        } else {
            return view("404");
        }
    }

    function getAllPost()
    {
        $posts = Story::all();
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
        $users = Login::all();
        return view('user', compact('users'));
    }
}
