<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use App\Http\Resources\LunchRatingResource;
use App\Models\LunchRating;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LunchRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
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

    public function store(Request $request, Lunch $lunch)
    {
        $validated = $request->validate([
            'hygiene_rating' => 'required|integer|min:0|max:5',
            'food_quality_rating' => 'required|integer|min:0|max:5',
            'food_variety_rating' => 'required|integer|min:0|max:5',
            'comment' => 'text',
            'lunch_id' => 'required',

            ['lunchrating' => $request->lunchrating]
        ]);

        $lunchrating = LunchRating::create($validated);
        return new LunchRatingResource($lunchrating);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return LunchRatingResource
     */
    public function show(Lunch $lunch, LunchRating $lunchrating, $id)
    {
        return LunchRating::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return LunchRatingResource
     */
    public function update(Request $request, Lunch $lunch, LunchRating $lunchrating, int $id)
    {
        $lunchrating = LunchRating::findOrFail($id);

        $validated = $request->validate([
            'hygiene_rating' => 'required|integer|min:0|max:5',
            'food_quality_rating' => 'required|integer|min:0|max:5',
            'food_variety_rating' => 'required|integer|min:0|max:5',
            'comment' => 'text',
        ]);

        $lunchrating = LunchRating::findOrFail($id);
        $lunchrating->update($validated);
        return new LunchRatingResource($lunchrating);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lunch $lunch, LunchRating $lunchRating,$id)
    {
        $lunchRating = LunchRating::findOrFail($id);
        $lunchRating->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
