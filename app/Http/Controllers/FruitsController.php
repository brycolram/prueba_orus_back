<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFruitRequest;
use App\Models\Fruit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FruitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits = Fruit::all();
        return $this->sendResponse($fruits);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFruitRequest $request)
    {
        //

       $fruit= Fruit::create($request->all());
        return $this->sendResponse($fruit);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFruitRequest $request, Fruit $fruit)
    {
        $fruit->update($request->all());
        return $this->sendResponse($fruit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        $fruit->delete();
        return $this->sendResponse("success");
    }
}
