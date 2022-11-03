<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return School
     */
    public function index()
    {
        //return SchoolResource::collection(School::with('fields', 'subjects', 'ratings')->paginate(25));

        $school = School::orderBy('created_at', 'asc')->get();
        return $school;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return School
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'type' => 'required'
        ]);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|mimes:jpg,png,jpeg,svg|max:2048',
            ]);


            $request->image->store('images', 'public');

            $school = new School([
                "name" => $request->get('name'),
                "address" => $request->get('address'),
                "type" => $request->get('type'),
                "file_path" => $request->image->hashName()
            ]);
            $school->save();
        }

        return $school;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return School
     */
    public function show(School $school)
    {
        //return new SchoolResource($school);

        return $school->load('lunch','fields');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return SchoolResource
     */
    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required'
        ]);

        $school->update($validated);
        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
