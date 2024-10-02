<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Api\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['message' => 'User  not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User  created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['message' => 'User  not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'User  updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['message' => 'User  not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User  deleted successfully']);
    }
}
