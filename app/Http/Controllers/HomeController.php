<?php

namespace App\Http\Controllers;
use App\Models\UsersInClassrooms;
use App\Models\Classroom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Reroute to home with classrooms for users
     * @return view
     */
    public static function Home(){
        $classes = [];

        if (\Auth::check())
        {
            $user = \Auth::id();
            $results = UsersInClassrooms::where('userId', '=', $user)->get();
            foreach($results as $r){
                $results = Classroom::where('id', '=', $r->classId)->get();
                $classes[] = $results;
            }
        }

        return view('home')->with("classes", $classes);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return HomeController::Home();
    }
}
