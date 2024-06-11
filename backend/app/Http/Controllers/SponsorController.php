<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class SponsorController extends Controller
{

    public function all(): JsonResponse
    {
        $sponsors = Sponsor::all(["id", "name", "image"]);

        return response()->json($sponsors);
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:12",
            "image" => "required"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Sponsor::create(request()->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Sponsor::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:12",
            "image" => "required|nullable"
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Sponsor::find($id)->updateOrFail($request->all());

        return response(status: 204);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:12",
            "image" => "required"
        ], $request->all());

        return $validated->passes();
    }
}
