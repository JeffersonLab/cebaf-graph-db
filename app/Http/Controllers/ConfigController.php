<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        return view('configs.index')->with('configs',Config::cursor());
    }

    public function create()
    {
        return view('configs.create')->with('config',Config::make());
    }

    public function store(Request $request)
    {
    }

    public function show(Config $config)
    {
        return view('configs.show')->with('configs',$config);
    }

    public function edit(Config $config)
    {
        return view('configs.edit')->with('config',$config);
    }

    public function update(Request $request, Config $config)
    {
    }

    public function destroy(Config $config)
    {
    }
}
