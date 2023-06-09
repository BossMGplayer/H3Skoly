<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Http\Resources\FieldResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $fields = Field::orderBy('created_at', 'asc')->get();

        $fields->each(function ($field) {
            $field->average_rating = $field->averageRating();
            unset($field->subjects);
        });

        //$averageRating = $fields->avg('average_rating');

        return response()->json([
            'fields' => $fields
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Field
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'school_id' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|max:2048',
            ]);

            $request->image->store('images', 'public');

            $field = new Field([
                "name" => $request->get('name'),
                "school_id" => $request->get('school_id'),
                "file_path" => $request->image->hashName()
            ]);
            $field->save();
        }

        return $field;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Field $field)
    {
        $field->load('subjects');
        $field->average_rating = $field->averageRating();

        return response()->json([
            'field' => $field,
            'average_rating' => $field->average_rating
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return FieldResource
     */
    public function update(Request $request, Field $field)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $field->update($validated);
        return new FieldResource($field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
