<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use Illuminate\Http\Request;
use App\Http\Resources\LunchResource;

class LunchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lunch = Lunch::orderBy('created_at', 'asc')->get();
        return $lunch;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Lunch
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

            $lunch = new Lunch([
                "name" => $request->get('name'),
                "school_id" => $request->get('school_id'),
                "file_path" => $request->image->hashName()
            ]);
            $lunch->save();
        }

        return $lunch;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return LunchResource
     */
    public function show(Lunch $lunch)
    {
        return new LunchResource($lunch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return LunchResource
     */
    public function update(Request $request, Lunch $lunch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lunch->update($validated);
        return new LunchResource($lunch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Lunch $lunch)
    {
        $lunch->delete();

        return response()->json(null, 204);
    }
}
