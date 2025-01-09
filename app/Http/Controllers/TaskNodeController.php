<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\TaskNode\ClassRoom;
use App\Models\TaskNode\Assignment;
use App\Models\TaskNode\TaskRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TaskNodeController extends Controller{
    protected $data;
    // public function __construct(){
    //     // $user = Auth::user();
    //     // $this->data['isCreate'] = (!$user->classRooms()->exists() && ReqRoute::route()->getName() !== 'create_ClassRoom');
    // }

    // VIEW
    public function index(Request $request){
        $user = Auth::user();
        $classRoom = $user->classRooms()->filter(['code' => $request['codeClass']])->get()->first();

        // tampilkan halaman error bahwa classroom tidak di temukan
        if($classRoom === null) abort(400, 'Classroom yang anda cari tidak ada!');
        
        // assignment dan record
        $assignments = $classRoom->assignments;
        return view('task-node.dashboard', [
            'user' => $user,
            'classRoom' => $classRoom,
            'categories' => $assignments->groupBy('category')->keys(),
            'title' => $assignments->groupBy('title')->keys(),
            'icon' => collect(Icon::$iconFontAwesome['solid']),
            'assignments' => $assignments->load('recordById')->reverse()
        ]);
    }
    // VIEW
    public function createClassRoom() {
        return view('task-node.create-class-room', [
            'user' => Auth::user(),
            'allClassRoom' => ClassRoom::skip(Auth::user()->id)->get(),
        ]);
    }


















    // LOGIC
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
        return redirect()->route('TaskNode');
    }
    public function logic_createTask(Request $request){
        // dd($request);
        $request['is_group'] = $request['is_group'] === 'on' ? true : false;
        $credentials = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'due_date' => 'nullable',
            'class_room_id' => 'exists:App\Models\TaskNode\ClassRoom,id',
            'description' => 'nullable',
            'is_group' => 'boolean',
            'creator_id' => 'exists:App\Models\User,id',
        ]);
        $user = Auth::user();
        // cek id user
        if($user->id != $credentials['creator_id']) abort(400, 'Permintaan tidak bisa dilakukan, silahkan coba lagi!');
        // cek classroom
        $classRoom = $user->classRooms->where('id', $credentials['class_room_id'])->first();
        if(!$classRoom) abort(400, 'Permintaan tidak bisa dilaksanakan, silahkan hubungi admin!');
        $request->session()->regenerate();
        $user->assignment()->create($credentials);
        return redirect('/TaskNode');
    }
    public function logic_updateTask(Request $request){
        $credentials = $request->validate([
            'tasks' => 'required|array',
            'tasks.*.assignment_id' => 'required',
            'tasks.*.status' => [
                'required', 
                Rule::in(['padding', 'in_progress', 'completed']),
            ], 
        ]);
        // $credentials['tasks'][0]['assignment_id']
        $credentials = $credentials['tasks'][0];
        // cek apakah user dan assignment terhubung ke buku yang sama?
        $user = Auth::user();
        $record = TaskRecord::where('user_id', $user->id)->where('assignment_id', $credentials['assignment_id'])->first();
        // cek apakah di taskRecord ada data ini
        if(!$record){
            // jika tidak ada buat baru + buat log
            $user->taskRecords()->create($credentials);
        }else{
            // jika ada update + buat log
            $record->status = $credentials['status'];
            $record->save();
        }
        $assignment = Assignment::find($credentials['assignment_id']);
        return response()->json([
            'success' => true,
            'message' => 'Tasks updated successfully',
            'assignment' => $assignment,
            'user' => $user,
            'record' => $record,
        ]);
    }
    public function logic_delete($id){
        $assignment = Assignment::find($id);
        $user = Auth::user();
        $classRoom = $user->classRooms->where('id', $assignment->class_room_id)->first();
        $data_log = [
            'action' => 'delete',
            'model' => 'TaskNode(Assignment)',
            'data' => [
                'before' => $assignment->toArray(),
            ],
        ];
        if(!$classRoom) return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk mengakses classroom ini!');
        if($user->id !== $assignment->creator->id){
            // cek tier user
            switch ($user->tier) {
                case 'admin':
                case 'super_admin':
                    $data_log ['description'] = $user->username."(".$user->tier.") menghapus tugas: ".$assignment->title;
                    break;
                default:
                    return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk menghapus tugas ini!');
            }
        }

        // Hapus assignment
        $assignment->delete();

        // Log
        $user->logs()->create($data_log);
        
        // hapus sassion
        request()->session()->regenerate();

        return redirect()->back()->with('success', 'Tugas berhasil anda hapus!.');
    }
}
