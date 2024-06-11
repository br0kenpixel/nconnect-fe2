<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function all(): JsonResponse
    {
        $reviews = Review::get(["id", "name", "opinion", "position", "image"]);

        return response()->json($reviews);
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:32",
            "opinion" => "required",
            "position" => "required",
            "image" => "required",
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Review::create($request->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Review::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:32",
            "opinion" => "required",
            "position" => "required",
            "image" => "nullable",
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        $keys = $request->all();

        if ($keys["image"] === null) {
            unset($keys["image"]);
        }

        Review::find($id)->updateOrFail($keys);

        return response(status: 204);
    }
}
