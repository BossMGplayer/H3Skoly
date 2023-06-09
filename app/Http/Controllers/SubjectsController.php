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
        $subjects = Subject::orderBy('created_at', 'asc')->get();
        $subjectResources = $subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'name' => $subject->name,
                'file_path' => $subject->file_path,
                'field_id' => $subject->field_id,
                'average_rating' => $subject->averageRating(),
                'created_at' => (string) $subject->created_at,
                'updated_at' => (string) $subject->updated_at,
            ];
        });

        return $subjectResources;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Subject
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'field_id' => 'required'
        ]);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|max:2048',
            ]);

            $request->image->store('images', 'public');

            $subject = new Subject([
                "name" => $request->get('name'),
                "field_id" => $request->get('field_id'),
                "file_path" => $request->image->hashName()
            ]);
            $subject->save();
        }

        return $subject;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return SubjectResource
     */
    public function show(int $id)
    {
        $subject = Subject::with('ratings')->findOrFail($id);
        $subjectResource = new SubjectResource($subject);

        return $subjectResource;
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
