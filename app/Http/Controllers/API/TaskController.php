<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'goal_id' => 'nullable|exists:goals,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $task = Task::create([
            'goal_id' => $request->goal_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'reward_id' => $request->reward_id,
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'goal_id' => 'nullable|exists:goals,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $task->update([
            'goal_id' => $request->goal_id,
            'title' => $request->title,
            'description' => $request->description,
            'reward_id' => $request->reward_id,
        ]);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();
        return response()->json(null, 204);
    }
}