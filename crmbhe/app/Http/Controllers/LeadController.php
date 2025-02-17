<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lead;


class LeadController extends Controller
{
    public function index()
    {
        return Lead::all();  // For simplicity, returning all leads.
    }

    public function store(Request $request)
    {
        // Validate incoming request
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:leads,email',
        //     'contact_number' => 'required|string|max:15',  // Add validation for contact_number
        // ]);

        $lead = Lead::create([
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'status' => $request->status, // Store role in database
            'assigned_to' => $request->assigned_to, // Store role in database            
        ]);

        return response()->json($lead, 201);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string|max:255',
    //     ]);

    //     $todo = Todo::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //     ]);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Todo created successfully',
    //         'todo' => $todo,
    //     ]);
    // }    
    public function update(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->update($request->all());
        return response()->json($lead);
    }
}
