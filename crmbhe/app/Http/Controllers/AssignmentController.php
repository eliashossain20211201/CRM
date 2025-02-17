<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function assignLead(Request $request, Lead $lead)
    {
        $assignment = Assignment::create([
            'lead_id' => $lead->id,
            'counselor_id' => $request->counselor_id,
            'assigned_by' => auth()->user()->id,
        ]);

        return response()->json($assignment);
    }
}
