<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataSetRequest;
use App\Http\Requests\UpdateDataSetRequest;
use App\Http\Resources\DataResource;
use App\Http\Resources\DataSetCollection;
use App\Http\Resources\DataSetResource;
use App\Models\Data;
use App\Models\DataSet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DataSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {

        $items = new DataSetCollection(DataSet::all());
        return Inertia::render('DataSet/Index', [
            'dataSets' =>  $items->toArray($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataSetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataSetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSet  $dataSet
     * @return \Inertia\Response
     */
    public function show(DataSet $dataSet)
    {
        $resource = new DataSetResource($dataSet);
        return Inertia::render('DataSet/Show', [
            'dataSet' =>  $resource,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSet  $dataSet
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSet $dataSet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataSetRequest  $request
     * @param  \App\Models\DataSet  $dataSet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataSetRequest $request, DataSet $dataSet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSet  $dataSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSet $dataSet)
    {
        //
    }
}
