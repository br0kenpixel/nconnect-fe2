<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Sponsor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ConferenceController extends Controller
{
    public function all(): JsonResponse
    {
        $conferences = Conference::all(["id", "year", "date"]);

        return response()->json($conferences);
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "year" => "required|integer",
            "date" => "required|date_format:d.m.Y"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Conference::create(request()->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Conference::find($id)->deleteOrFail();
        return response(status: 201);
    }
}
