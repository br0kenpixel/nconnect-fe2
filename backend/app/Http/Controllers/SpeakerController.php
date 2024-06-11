<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SpeakerController extends Controller
{
    public function all(): JsonResponse
    {
        $speakers = Speaker::all(["id", "name", "company", "description", "image", "headliner"]);

        return response()->json($speakers);
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:64",
            "company" => "required|max:12",
            "description" => "required",
            "image" => "required",
            "headliner" => "required|boolean"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Speaker::create(request()->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Speaker::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:64",
            "company" => "required|max:12",
            "description" => "required",
            "image" => "nullable",
            "headliner" => "required|boolean"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        $keys = $request->all();

        if ($keys["image"] === null) {
            unset($keys["image"]);
        }

        Speaker::find($id)->updateOrFail($keys);

        return response(status: 204);
    }
}
