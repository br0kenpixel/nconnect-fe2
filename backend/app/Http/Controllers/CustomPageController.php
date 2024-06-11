<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\JsonResponse;

class CustomPageController extends Controller
{
    public function all(): JsonResponse
    {
        $pages = CustomPage::all(["id", "name", "display"]);

        return response()->json($pages);
    }

    public function get(int $id): JsonResponse
    {
        $page = CustomPage::find($id, ["id", "name", "content", "display"]);

        if ($page === null) {
            abort(404);
        }

        return response()->json($page);
    }
}
