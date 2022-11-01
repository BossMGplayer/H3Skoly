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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //return FieldResource::collection(Field::with('subjects', 'school')->paginate(25));

        // Can use the 'school' relation to return the owner school
        $field = Field::orderBy('created_at', 'asc')->get();
        return $field;
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
            'school_id' => 'required'
        ]);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $request->image->store('images', 'public');

            $field = new Field([
                "name" => $request->get('name'),
                "address" => $request->get('address'),
                "type" => $request->get('type'),
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
     * @return Field
     */
    public function show(Field $field)
    {
        return $field->load('subjects');
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
