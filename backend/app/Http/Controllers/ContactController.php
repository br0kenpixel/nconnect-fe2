<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function all(): JsonResponse
    {
        $reviews = Contact::get(["id", "name", "phone", "email", "image"]);

        return response()->json($reviews);
    }

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:24",
            "phone" => "required|max:13",
            "email" => "required|email:rfc,dns",
            "image" => "required",
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        Contact::create($request->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Contact::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|max:24",
            "phone" => "required|max:13",
            "email" => "required|email",
            "image" => "nullable",
        ], $request->all());

        if ($validated->fails()) {
            return response(status: 400);
        }

        $keys = $request->all();

        if ($keys["image"] === null) {
            unset($keys["image"]);
        }

        Contact::find($id)->updateOrFail($keys);

        return response(status: 204);
    }
}
