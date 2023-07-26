<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataSetRequest;
use App\Http\Requests\UpdateDataSetRequest;
use App\Http\Resources\DataSetCollection;
use App\Http\Resources\DataSetResource;
use App\Models\DataSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $items = new DataSetCollection(DataSet::cursor());

        return Inertia::render('DataSet/ListView', [
            'dataSets' => $items->toArray($request),
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataSetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response
     */
    public function show(DataSet $dataSet)
    {
        $resource = new DataSetResource($dataSet);

        return Inertia::render('DataSet/ItemView', [
            'dataSet' => $resource,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSet $dataSet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataSetRequest $request, DataSet $dataSet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSet $dataSet)
    {
        //
    }

    public function zip(DataSet $dataSet)
    {
        try {
            if (! Storage::exists('public/'.$dataSet->publicZipFile())) {
                $dataSet->makePublicZipFile();
//                sleep(1);  // time to flush to disk?
            }

            return Storage::download('public/'.$dataSet->publicZipFile());
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
