<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request)
    {
        //1. validator
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //2. check validaror error
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "errors" => $validator->errors()
            ], 422);
        }

        //3. upload image
        $image = $request->file('cover_photo');
        $image->store('books','public');

        //4. insert data
        $authors = Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'cover_photo' => $image->hashName(),
        ]);

        //5. response
        return response()->json([
            "success" => true,
            "message" => "Genres created successfully",
            "data" => $authors
        ], 201);
    }
}
