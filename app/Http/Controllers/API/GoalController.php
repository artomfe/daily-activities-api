<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        return response()->json($goals);
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
            'title' => 'required|string',
            'description' => 'nullable|string',
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $goal = Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'reward_id' => $request->reward_id,
        ]);

        return response()->json($goal, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($goal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'reward_id' => $request->reward_id,
        ]);

        return response()->json($goal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $goal->delete();
        return response()->json(null, 204);
    }
}