<?php

namespace App\Http\Controllers;

use App\Models\LunchRating;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Resources\LunchRatingResource;
use Symfony\Component\HttpFoundation\Response;

class LunchRatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lunchRating = LunchRating::orderBy('created_at', 'asc')->get();
        return $lunchRating;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LunchRatingResource
     */
    public function store(Request $request, LunchRating $lunchRating)
    {
        $validated = $request->validate([
            'food_rating' => 'required|integer|min:1|max:5',
            'hygiene_rating' => 'required|integer|min:1|max:5',
            'food_variations_rating' => 'required|integer|min:1|max:5',
            'comment' => 'string',
            'lunch_id' => 'required',

            ['lunchRating' => $request->lunchRating]
        ]);

        $lunchRating = LunchRating::create($validated);
        return new LunchRatingResource($lunchRating);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return LunchRatingResource
     */
    public function show(School $school, LunchRating $lunchRating)
    {
        return new LunchRatingResource($lunchRating);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return LunchRatingResource
     */
    public function update(Request $request,School $school, LunchRating $lunchRating)
    {
        $validated = $request->validate([
            'food_rating' => 'required|integer|min:1|max:5',
            'hygiene_rating' => 'required|integer|min:1|max:5',
            'food_variations_rating' => 'required|integer|min:1|max:5',
        ]);

        $lunchRating->update($validated);
        return new LunchRatingResource($lunchRating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school, LunchRating $lunchRating)
    {
        $lunchRating->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
