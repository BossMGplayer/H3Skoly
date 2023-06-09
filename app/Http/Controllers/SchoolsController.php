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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $schools = School::orderBy('created_at', 'asc')->get();

        $schools->each(function ($school) {
            $school->average_rating = $school->calculateSchoolRating();
            unset($school->fields);
            unset($school->lunch);
        });

        return response()->json([
            'schools' => $schools,
        ]);
    }




    public function indexWeb()
    {
        $school = School::orderBy('created_at', 'asc')->get();
        return view('allSchools', compact('school'));
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
        $school->load('lunch', 'fields');
        $school->average_rating = $school->calculateSchoolRating();

        return $school;
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
        //$school->School::findOrFail($id);
        $school->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
