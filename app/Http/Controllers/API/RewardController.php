<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = Reward::all();
        return response()->json($rewards);
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
            'xp_reward' => 'nullable|integer',
            'gold_reward' => 'nullable|integer',
        ]);

        $reward = Reward::create($request->all());

        return response()->json($reward, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        return response()->json($reward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        $request->validate([
            'xp_reward' => 'nullable|integer',
            'gold_reward' => 'nullable|integer',
        ]);

        $reward->update($request->all());

        return response()->json($reward);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return response()->json(null, 204);
    }

    /**
     * List rewards formatted for select.
     *
     * @return \Illuminate\Http\Response
     */
    public function listForSelect()
    {
        $rewards = Reward::all()->map(function ($reward) {
            return [
                'id' => $reward->id,
                'name' => ($reward->xp_reward ? $reward->xp_reward . ' XP' : '') .
                          ($reward->xp_reward && $reward->gold_reward ? ' + ' : '') .
                          ($reward->gold_reward ? $reward->gold_reward . ' Gold' : ''),
            ];
        });

        return response()->json($rewards);
    }
}