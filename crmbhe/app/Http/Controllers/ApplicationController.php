<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $application = Application::create($request->all());
        return response()->json($application, 201);
    }

    public function update(Request $request, $id)
    {
        $application = Application::find($id);
        $application->update($request->all());
        return response()->json($application);
    }
}

