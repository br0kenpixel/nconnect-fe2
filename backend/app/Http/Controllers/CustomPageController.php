<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    public function all(): JsonResponse
    {
        $pages = CustomPage::all(["id", "name", "display"]);

        return response()->json($pages);
    }
}
