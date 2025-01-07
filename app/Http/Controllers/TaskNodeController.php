<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TaskNode\ClassRoom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as ReqRoute;
use Illuminate\Http\Request;


class TaskNodeController extends Controller{
    protected $data;
    public function __construct(){
        $user = Auth::user();
        $this->data['isCreate'] = (!$user->classRooms()->exists() && ReqRoute::route()->getName() !== 'create_ClassRoom');
    }

    public function index(){
        $user = Auth::user();
        if ($this->data['isCreate']) {
            return $this->createClassRoom();
        }
        return view('task-node.dashboard', [
            'user' => $user,
            'data' => [],
        ]);
    }
    public function createClassRoom() {
        return view('task-node.create-class-room', [
            'user' => Auth::user(),
            'allClassRoom' => ClassRoom::with(['assignments'])->skip(Auth::user()->id)->get(),
        ]);
    }
    public function logic_createClassRoom(Request $request){
        // $request = $request->validate([]);
        $user = Auth::user();
        if($request['form'] === 'join'){
            // join
            $classRoom = ClassRoom::where('code', $request['code'])->first();
            $user->logs()->create([
                'model' => 'TaskNode(Classroom)',
                'action' => 'join',
                'data' => [
                    'after' => $classRoom->toArray(),
                ],
            ]);
        }else{
            // create
            $code = Str::random(5);
            while (ClassRoom::where('code', $code)->first() !== null) { $code = Str::random(5); }
            $data = [
                'code' => $code,
                'creator_id' => $user->id,
                'name' => $request['name'],
                'description' => $request['description'],
            ];
            $classRoom = ClassRoom::create($data);
            $user->logs()->create([
                'model' => 'TaskNode(Classroom)',
                'action' => 'create',
                'data' => [
                    'after' => $classRoom->toArray(),
                ],
            ]);
        }
        $request->session()->regenerate();
        $user->classRooms()->attach($classRoom->id);
    }
}
