<?php

namespace App\Http\Controllers\Api;

use App\Models\Wolf;
use App\Http\Controllers\Controller;
use App\Http\Resources\WolfResource;
use App\Http\Requests\WolfStoreRequest;
use App\Http\Requests\WolfUpdateRequest;

class WolfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WolfResource::collection(Wolf::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WolfStoreRequest $request)
    {
        $wolf = Wolf::create($request->validated());

        return new WolfResource($wolf->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Wolf $wolf)
    {
        return new WolfResource($wolf);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WolfUpdateRequest $request, Wolf $wolf)
    {
        $wolf->update($request->validated());

        return new WolfResource($wolf->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wolf $wolf)
    {
        $wolf->delete();
        return response([], 204);
    }
}
