<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
