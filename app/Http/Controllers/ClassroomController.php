<?php


namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Posts;
use App\Models\UsersInClassrooms;
use App\Models\User;
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
        $class = Classroom::firstOrCreate([
            'ownerId' => $request->user()->id,
            'className' => $request->className,
            'uuid' => Uuid::uuid4(),
            'linkingCode' => bin2hex(random_bytes(4)),
            'section' => $request->section,
            'subject' => $request->subject,
            'room' => $request->room
        ]);

        UsersInClassrooms::firstOrCreate([
            'userId' => $request->user()->id,
            'classId' => $class->id
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

        $posts = Posts::orderBy('id', 'DESC')
        ->where('classId', '=', $classroom->id)
        ->paginate(15);
        
        $users = [];
        $i=0;
        
        foreach ($posts as $post) {
            $users[$i] = User::find($post->userId)->name;
            $i++;
        }

        if($results > 0) {
            return view('class.class')
                ->with("posts",       $posts                            )
                ->with("id",          $classroom->id                    )
                ->with("className",   $classroom->className             )
                ->with("linkingCode", $classroom->linkingCode           )
                ->with("ownerId",     $classroom->ownerId               )
                ->with("isOwner",    ($classroom->ownerId == $user)     )
                ->with("section",     $classroom->section               )
                ->with("subject",     $classroom->subject               )
                ->with("room",        $classroom->room                  )
                ->with("uuid",        $classroom->uuid                  )
                ->with("users",       $users                            )
                ->with("i",           0                                 )
                ->with("secondaryNav",1                                 );
        } else {
            return HomeController::Home();
        }
    }
}
