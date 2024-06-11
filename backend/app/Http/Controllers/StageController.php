<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StageController extends Controller
{
    public function all(): JsonResponse
    {
        $stages = Stage::with("conference:id,year,date")->get(["id", "conference", "name"])->all();

        return response()->json($stages);
    }

    public function create(Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        Stage::create(request()->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Stage::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        Stage::find($id)->updateOrFail($request->all());

        return response(status: 204);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "conference" => "required|integer",
            "name" => "required|max:16"
        ], $request->all());

        return $validated->passes();
    }
}
