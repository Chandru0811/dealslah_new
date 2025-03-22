<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $subCategory = SubCategory::orderBy('id', 'desc')->get();
        return $this->success('SubCategory Retrieved Successfully!', $subCategory);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:200|unique:sub_categories,name,NULL,id,deleted_at,NULL',
            'slug'        => 'required|string|max:200|unique:sub_categories,slug,NULL,id,deleted_at,NULL',
            'description' => 'nullable|string',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'active'      => 'nullable|boolean'
        ], [
            'category_id.required' => 'The category id field is required.',
            'category_id.exists'   => 'The selected category id is invalid.',
            'name.required'        => 'The name field is required.',
            'name.unique'          => 'The name field must be unique.',
            'name.max'             => 'The name may not be greater than 200 characters.',
            'slug.required'        => 'The slug field is required.',
            'slug.max'             => 'The slug may not be greater than 200 characters.',
            'slug.unique'          => 'The slug must be unique.',
            'description.string'   => 'The description must be a string.',
            'image.required'        => 'The image is required.',
            'image.image'           => 'The image must be an actual image file.',
            'image.mimes'           => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'image.max'             => 'The image must not be larger than 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = public_path('assets/images/subcategories');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($imagePath, $imageName);
            $validatedData['path'] = 'assets/images/subcategories/' . $imageName;
        }

        $subCategory = SubCategory::create($validatedData);

        return response()->json(['message' => 'SubCategory Created Successfully!', 'data' => $subCategory], 201);
    }


    public function show(string $id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return $this->error('SubCategory Not Found.', ['error' => 'SubCategory Not Found']);
        }
        return $this->success('SubCategory Retrived Succesfully!', $subCategory);
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return $this->error('Sub Category Not Found.', ['error' => 'Sub Category Not Found']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required|exists:categories,id',
                'name'        => 'required|string|max:200|unique:sub_categories,name,' . $id . ',id,deleted_at,NULL',
                'slug'        => 'required|string|max:200|unique:sub_categories,slug,' . $id . ',id,deleted_at,NULL',
                'description' => 'nullable|string',
                'image'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'active'      => 'boolean|nullable',
            ],
            [
                'category_id.required' => 'The category id field is required.',
                'category_id.exists'   => 'The selected category id is invalid.',
                'name.required'        => 'The name field is required.',
                'name.unique'          => 'The name field must be unique.',
                'name.max'             => 'The name may not be greater than 200 characters.',
                'slug.required'        => 'The slug field is required.',
                'slug.max'             => 'The slug may not be greater than 200 characters.',
                'slug.unique'          => 'The slug must be unique.',
                'description.string'   => 'The description must be a string.',
                'image.image'           => 'The image must be an actual image file.',
                'image.mimes'           => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
                'image.max'             => 'The image must not be larger than 2MB.',
                'active.boolean'       => 'The active field must be true or false.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('image')) {
            if ($subCategory->path && file_exists($subCategory->path)) {
                unlink($subCategory->path);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'assets/images/subcategories';

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);

            $validatedData['path'] = $imagePath . "/" . $imageName;
        }

        $subCategory->update($validatedData);

        return response()->json(['message' => 'SubCategory Updated Successfully!', 'data' => $subCategory], 200);
    }


    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return $this->ok('SubCategory Deleted Successfully!');
    }
}
