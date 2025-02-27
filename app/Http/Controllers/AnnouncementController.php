<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AnnouncementController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $announcements = Announcement::all();
        return $this->success( 'Products retrieved successfully.',$announcements);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|string',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|image|',
            'image_url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_global' => 'required|boolean',
            'shop_id' => 'nullable|exists:shops,id',
            'active' => 'nullable|boolean',
        ], [
            'title.required' => 'The title field is required.',
            'message.required' => 'The message field is required.',
            'type.required' => 'The type field is required.',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a jpeg, png, jpg, gif, or svg file.',
            'image.max' => 'The image must not be larger than 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'assets/announcements';

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);

            $validatedData['image_url'] = $imagePath . "/" . $imageName;
        }

        $announcement = Announcement::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Announcement created successfully.',
            'data' => $announcement
        ], 201);
    }

    public function show(string $id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return $this->error('Announcement Not Found.', ['error' => 'Announcement Not Found']);
        }
        return $this->success('Announcement Retrived Succesfully!', $announcement);
    }

    public function update(Request $request, string $id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return $this->error('Announcement Not Found.', ['error' => 'Announcement Not Found']);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_global' => 'required|boolean',
            'shop_id' => 'nullable|exists:shops,id',
            'active' => 'nullable|boolean',
        ], [
            'title.required' => 'The title field is required.',
            'message.required' => 'The message field is required.',
            'type.required' => 'The type field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a jpeg, png, jpg, gif, or svg file.',
            'image.max' => 'The image must not be larger than 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'assets/announcements';

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);

            $validatedData['image_url'] = $imagePath . "/" . $imageName;
        }

        // Update announcement with validated data
        $announcement->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Announcement updated successfully.',
            'data' => $announcement
        ], 200);
    }


    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return $this->ok('Announcement Deleted Successfully!');
    }
}
