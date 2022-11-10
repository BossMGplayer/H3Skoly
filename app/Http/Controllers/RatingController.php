<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Resources\RatingResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //return SchoolResource::collection(School::with('fields', 'subjects', 'ratings')->paginate(25));

        $rating = Rating::orderBy('created_at', 'asc')->get();
        return $rating;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RatingResource
     */

    public function store(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'subject_rating' => 'required|integer|min:1|max:5',
            'teacher_rating' => 'required|integer|min:1|max:5',
            'knowledge_rating' => 'required|integer|min:1|max:5',
            'comment' => 'text',
            'subject_id' => 'required',

            ['rating' => $request->rating]
        ]);

        $rating = Rating::create($validated);
        return new RatingResource($rating);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RatingResource
     */
    public function show(Subject $subject, Rating $rating)
    {
        return new RatingResource($rating);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RatingResource
     */
    public function update(Request $request, Subject $subject, Rating $rating)
    {
        $validated = $request->validate([
            'subject_rating' => 'required|integer|min:0|max:5',
            'teacher_rating' => 'required|integer|min:0|max:5',
            'knowledge_rating' => 'required|integer|min:0|max:5',
            'comment' => 'text',
        ]);

        $rating->update($validated);
        return new RatingResource($rating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Rating $rating)
    {
        $rating->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

