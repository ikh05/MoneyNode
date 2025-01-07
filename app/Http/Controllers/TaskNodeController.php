<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TaskNode\ClassRoom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TaskNodeController extends Controller{
    protected $data;
    // public function __construct(){
    //     // $user = Auth::user();
    //     // $this->data['isCreate'] = (!$user->classRooms()->exists() && ReqRoute::route()->getName() !== 'create_ClassRoom');
    // }

    public function index(Request $request){
        $user = Auth::user();
        $classRoom = $user->classRooms()->filter($request)->with(['assignments.records'])->get()->first();

        // tampilkan halaman error bahwa classroom tidak di temukan
        if($classRoom === null) abort(400, 'Classroom yang anda cari tidak ada!');
        
        // categories yang sudah ada didalam assigment
        $categories = $classRoom->assignments->groupBy('category')->keys();
        
        return view('task-node.dashboard', [
            'user' => $user,
            'classRoom' => $classRoom,
            'categories' => $categories,
            'icon' => collect(Icon::$iconFontAwesome['solid']),
        ]);
    }
    
    public function createClassRoom() {
        return view('task-node.create-class-room', [
            'user' => Auth::user(),
            'allClassRoom' => ClassRoom::skip(Auth::user()->id)->get(),
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
            $request->session()->regenerate();
        }
        $user->classRooms()->attach($classRoom->id);
    }

    public function logic_createTask(Request $request){
        // dd($request);
        $credentials = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'deu_date' => 'nullable',
            'class_room_id' => 'integer',
            'description' => 'nullable',
        ]);
        // cek classroom
        $classRoom = Auth::user()->classRooms->where('id', $credentials['class_room_id'])->first();
        if(!$classRoom) abort(400, 'Permintaan ada tidak bisa dilaksanakan, silahkan hubungi admin!');;
        $classRoom->assignments()->create($credentials);
        $request->session()->regenerate();
        return redirect('/TaskNode');
    }
}
