<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        CustomPage::create($request->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        CustomPage::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        CustomPage::find($id)->updateOrFail($request->all());

        return response(status: 204);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:16",
            "content" => "required",
            "display" => "required"
        ], $request->all());

        if ($validated->fails()) {
            return false;
        }

        if (!in_array($request->input("display"), [CustomPage::DISPLAY_NONE, CustomPage::DISPLAY_NAV, CustomPage::DISPLAY_BOTTOM])) {
            return false;
        }

        return true;
    }
}
