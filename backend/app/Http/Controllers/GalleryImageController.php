<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GalleryImageController extends Controller
{
    public function all(): JsonResponse
    {
        $result = [];
        $i = 0;
        $conferences = Conference::get(["id", "year", "date"])->all();

        foreach ($conferences as $conference) {
            $images = GalleryImage::whereColumn("conference", "=", $conference->id)->get(["id", "image"])->all();

            $result[$i++] = [
                "conference" => $conference,
                "gallery" => $images,
            ];
        }

        return response()->json($result);
    }

    public function create(Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        foreach ($request->input("gallery") as $image) {
            GalleryImage::create([
                "conference" => $request->input("conference"),
                "image" => $image,
            ]);
        }

        return response(status: 201);
    }

    public function update(Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        GalleryImage::where("conference", "=", $request->input("conference"))->delete();

        foreach ($request->input("gallery") as $image) {
            GalleryImage::create([
                "conference" => $request->input("conference"),
                "image" => $image,
            ]);
        }

        return response(status: 204);
    }

    public function delete(int $id): Response
    {
        GalleryImage::where("conference", "=", $id)->delete();

        return response(status: 204);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "conference" => "required|integer",
            "gallery" => "required|array",
        ], $request->all());

        return $validated->passes();
    }
}
