<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\JsonResponse;


class SponsorController extends Controller
{

    public function all(): JsonResponse
    {
        $sponsors = Sponsor::all(["id", "name", "image"]);

        return response()->json($sponsors);
    }
}
