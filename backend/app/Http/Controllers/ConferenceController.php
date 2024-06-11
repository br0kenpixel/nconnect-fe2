<?php

namespace App\Http\Controllers;

use App\Models\Conference;
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
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        Conference::create(request()->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Conference::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        Conference::find($id)->updateOrFail($request->all());

        return response(status: 201);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "year" => "required|integer",
            "date" => "required|date_format:d.m.Y"
        ], $request->all());

        return $validated->passes();
    }
}
