<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //return SubjectResource::collection(Subject::with('ratings')->get());

        $subject = Subject::orderBy('created_at', 'asc')->get();
        return $subject;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return SubjectResource
     */
    public function store(Request $request)
    {
        $subject = Subject::create([
            'field_id' => $request->field_id,
            'name' => $request->name,
        ]);

        return new SubjectResource($subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return SubjectResource
     */
    public function show(Subject $subject)
    {
        //return $subject->load('ratings');
        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return SubjectResource
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($validated);
        return new SubjectResource($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json(null, 204);
    }
}
