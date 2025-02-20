<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function assignLead(Request $request)
    {
        $assignment = Assignment::create([
            'lead_id' => $request->lead_id,
            'counselor_id' => $request->counselor_id,
            'assigned_by' => auth()->user()->id,
        ]);

        return response()->json($assignment);
    }
}
