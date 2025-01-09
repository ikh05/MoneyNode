<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskNode\Assignment;
use Illuminate\Support\Facades\Http;

    // http://api.scraperapi.com?api_key=ad23062b57dbed31858f54691da6511f&url=https://ica.free.nf/bot/telegram

class IcABotTelegramController extends Controller{
    public function index()
    {
        return Assignment::all();
    }

    // Get a single Assignment
    public function show($id)
    {
        $Assignment = Assignment::find($id);

        if (!$Assignment) {
            return response()->json(['message' => 'Assignment not found'], 404);
        }

        return response()->json($Assignment);
    }

    // Create a new Assignment
    public function store(Request $request)
    {
        $Assignment = Assignment::create($request->all());
        return response()->json($Assignment, 201);
    }

    // Update a Assignment
    public function update(Request $request, $id)
    {
        $Assignment = Assignment::find($id);

        if (!$Assignment) {
            return response()->json(['message' => 'Assignment not found'], 404);
        }

        $Assignment->update($request->all());
        return response()->json($Assignment);
    }

    // Delete a Assignment
    public function destroy($id)
    {
        $Assignment = Assignment::find($id);

        if (!$Assignment) {
            return response()->json(['message' => 'Assignment not found'], 404);
        }

        $Assignment->delete();
        return response()->json(['message' => 'Assignment deleted']);
    }
}
