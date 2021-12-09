<?php

namespace App\Http\Controllers\Api;

use App\Models\Pack;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackResource;
use App\Http\Requests\PackStoreRequest;
use App\Http\Requests\PackUpdateRequest;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PackResource::collection(Pack::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackStoreRequest $request)
    {
        $pack = Pack::create($request->validated());

        return new PackResource($pack->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pack $pack)
    {
        return new PackResource($pack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackUpdateRequest $request, Pack $pack)
    {
        $pack->update($request->validated());

        return new PackResource($pack->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pack $pack)
    {
        $pack->delete();

        return response([], 204);
    }
}
