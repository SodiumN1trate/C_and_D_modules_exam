<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'username' => 'string|required',
            'password' => 'string|required',
        ]);

        $user = User::where('username', $validated['username'])->first();

        if(Hash::check($validated['password'], $user->password)) {
            $user->token = Str::random(40);
            $user->save();
            return response()->json([
                'token' => $user->token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'error' => 'Invalid credentials',
        ], 401);
    }

    public function getTeams() {
        return TeamResource::collection(Team::all());
    }

    public function setTeam(Request $request) {
        $validated = $request->validate([
            'name' => 'string|required',
            'contactEmail' => 'string|required',
            'plannedStartingTime' => '',
            'startingTime' => '',
        ]);
        $validated['accessCode'] = rand(99999999, 999999999);
        $team = Team::create($validated);
        return new TeamResource($team);
    }

    public function editTeam(Request $request, $team) {
        $team = Team::find($team);
        if(!isset($team)) {
            return response()->json([
                'message' => 'Team not found',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'string|required',
            'contactEmail' => 'string|required',
            'plannedStartingTime' => '',
            'startingTime' => '',
        ]);
        $team->update($validated);
        return new TeamResource($team);
    }

    public function deleteTeam($team) {
        $team = Team::find($team);
        if(!isset($team)) {
            return response()->json([
                'message' => 'Team not found',
            ], 404);
        }
        $team->delete();

        return response()->json([], 204);
    }
}
