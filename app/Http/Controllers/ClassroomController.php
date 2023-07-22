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
            'linkingCode' => bin2hex(random_bytes(4)),
            'section' => $request->section,
            'subject' => $request->subject,
            'room' => $request->room
        ]);

        return HomeController::Home();
    }

    function join(Request $request)
    {
        $user = $request->user()->id;
        $classroom = Classroom::where('linkingCode', '=', $request->classId)->get();
        $classroom = $classroom[0];

        UsersInClassrooms::firstOrCreate([
            'userId' => $request->user()->id,
            'classId' => $classroom->id,
        ]);

        return HomeController::Home();
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

    public function getClass(Request $request, $class = null){
        $user = $request->user()->id;
        $classroom = Classroom::where('uuid', '=', $class)->get();
        $classroom = $classroom[0];

        $results = UsersInClassrooms::where('userId', '=', $user)
            ->where('classId', '=', $classroom->id)->count();

        if($results > 0) {
            return view('class.class')
                ->with("className",   $classroom->className)
                ->with("linkingCode", $classroom->linkingCode)
                ->with("ownerId",     $classroom->ownerId)
                ->with("section",     $classroom->section)
                ->with("subject",     $classroom->subject)
                ->with("room",        $classroom->room)
                ->with("uuid",        $classroom->uuid);
        } else {
            return HomeController::Home();
        }
    }
}
