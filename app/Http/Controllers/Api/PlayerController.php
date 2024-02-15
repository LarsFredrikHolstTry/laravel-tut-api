<?php

namespace App\Http\Controllers\Api;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();

        if($players->isEmpty()){
            return response()->json([
                'message' => 'No players found',
                'status' => 404,
            ]);
        }

        return response()->json([
            'data' => $players,
            'status' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:players',
            'password' => 'required',
        ]);

        $player = Player::create($request->all());

        return response()->json([
            'data' => $player,
            'status' => 201,
        ]);
    }

    public function show(int $id)
    {
        $player = Player::find($id);

        if(!$player){
            return response()->json([
                'message' => 'Player not found',
                'status' => 404,
            ]);
        }

        return response()->json([
            'data' => $player,
            'status' => 200,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $player = Player::find($id);

        if(!$player){
            return response()->json([
                'message' => 'Player not found',
                'status' => 404,
            ]);
        }

        if(!$player->update($request->all())){
            return response()->json([
                'message' => 'Error updating player',
                'status' => 500,
            ]);
        };

        return response()->json([
            'data' => $player,
            'status' => 200,
        ]);
    }

    public function destroy(int $id)
    {
        $player = Player::find($id);

        if(!$player){
            return response()->json([
                'message' => 'Player not found',
                'status' => 404,
            ]);
        }

        if(!$player->delete()){
            return response()->json([
                'message' => 'Error deleting player',
                'status' => 500,
            ]);
        };

        return response()->json([
            'message' => 'Player deleted',
            'status' => 200,
        ]);
    }
}
