<?php


namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\UsersInClassrooms;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ClassroomController
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\Models\Classroom
     */
    function create(Request $request)
    {
        Classroom::firstOrCreate([
            'ownerId' => $request->user()->id,
            'className' => $request->className,
            'uuid' => Uuid::uuid4(),
            'section' => $request->section,
            'subject' => $request->subject,
            'room' => $request->room
        ]);

        return view('home');
    }

    function join(Request $request)
    {
        Classroom::findOrFail($request->classId);
        UsersInClassrooms::firstOrCreate([
            'userId' => $request->user()->id,
            'classId' => $request->classId,
        ]);

        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getClass(Request $request, $class = null){
        $user = $request->user()->id;

        $results = UsersInClassrooms::where('userId', '=', $user)
            ->where('classId', '=', $class)->count();

        if($results > 0) {
            $classroom = Classroom::findOrFail($class);
            return view('class.class')
                ->with("className", $classroom->className)
                ->with("ownerId",    $classroom->ownerId)
                ->with("section",    $classroom->section)
                ->with("subject",    $classroom->subject)
                ->with("room",          $classroom->room);
        } else {
            return view('home');
        }
    }
}
