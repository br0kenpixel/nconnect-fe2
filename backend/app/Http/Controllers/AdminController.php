<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function get(): JsonResponse
    {
        return response()->json(User::get(["id", "name", "email"])->all());
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:32",
            "email" => "required|email",
            "password" => "required"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        User::create([
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "password" => Hash::make($request->input("password"))
        ]);

        return response(status: 201);
    }

    public function update(int $id, Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:32",
            "email" => "required|email",
            "password" => "nullable"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        $user = User::findOrFail($id);

        if ($request->input("password") !== null) {
            $hashed = Hash::make($request->input("password"));

            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = $hashed;
            $user->save();
        } else {
            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->save();
        }

        return response(status: 204);
    }

    public function delete(int $id): Response
    {
        if ($id === 1) {
            return response(status: 400);
        }

        User::find($id)->deleteOrFail();

        return response(status: 204);
    }
}
