<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataSetRequest;
use App\Http\Requests\UpdateDataSetRequest;
use App\Http\Resources\DataSetCollection;
use App\Http\Resources\DataSetResource;
use App\Models\DataSet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;


class DataSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        return view('data_sets.index')->with('dataSets',DataSet::cursor());
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        $this->authorize('create-data-set');
        return view('data_sets.create')->with('dataSet',DataSet::make());
    }


    /**
     * Display the specified resource.
     */
    public function show(DataSet $dataSet): View
    {
        return view('data_sets.show')->with('dataSet',$dataSet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(DataSet $dataSet): View
    {
        $this->authorize('edit-data-set', $dataSet);
        return view('data_sets.edit')->with('dataSet',$dataSet);
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
