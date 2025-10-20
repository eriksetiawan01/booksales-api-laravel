<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $image->store('authors','public');

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

    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found",
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail resource",
            "data" => $author
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        // 1. mencari data
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found",
            ], 404);
        }

        //2. validator
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "errors" => $validator->errors()
            ], 422);
        }

        //3. siapkan data yang ingin di update
        $data = [
            'name' => $request->name,
            'bio' => $request->bio,
        ];

        //4. handle image (upload & delete old image)
        if ($request->hasFile('cover_photo')) {
            //delete old image
            if ($author->cover_photo) {
                Storage::disk('public')->delete('authors/'.$author->cover_photo);
            }
            //upload new image
            $image = $request->file('cover_photo');
            $image->store('authors','public');
            $data['cover_photo'] = $image->hashName();
        }

        //5. update data ke database
        $author->update($data);

        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully",
            "data" => $author
        ], 200);
    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found",
            ], 404);
        }

        if ($author->cover_photo) {
            //delete from storage
            Storage::disk('public')->delete('authors/'.$author->cover_photo);
        }

        $author->delete();
        
        return response()->json([
            "success" => true,
            "message" => "Resource deleted successfully",
        ]);
    }
}
