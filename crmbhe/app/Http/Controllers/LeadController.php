<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;



class LeadController extends Controller
{
    public function __construct()
    {

        // Apply JWT authentication to all methods
         $this->middleware('auth:api');
       // $this->middleware('jwt.auth');
        
    }

    public function leads()
    {
        Log::info('Leads function was called.');
        return Lead::all();  // For simplicity, returning all leads.
    }
    
    public function unassignedLeads()
    {
        Log::info('Unassigned leads function was called.');
        
        // Fetch leads where status is 'new'
        $unassignedLeads = Lead::where('status', 'new')->get();

        return response()->json($unassignedLeads);
    }    
    /**
     * Create a new lead (Admin only)
     */
    public function store(Request $request)
    {

        // Ensure the authenticated user is an admin
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Only admins can create leads.'
            ], 403);
        }


        // Create a new lead
        $lead = Lead::create([
            'name' => $request->name,
            'contact_number' => $request->contact_number,            
            'email' => $request->email,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Lead created successfully',
            'lead' => $lead
        ], 201);
    }

    // public function assignLead(Request $request)
    // {
    //     $lead = Lead::findOrFail($request->lead_id);
    //     $lead->counselor_id = $request->counselor_id;
    //     $lead->save();

    //     return response()->json(['message' => 'Lead assigned successfully']);
    // }

    public function updateLeadStatus(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->status = $request->status;
        $lead->save();

        return response()->json(['message' => 'Lead status updated']);
    }

}






// namespace App\Http\Controllers;
// use Illuminate\Http\Request;
// use App\Models\Lead;


// class LeadController extends Controller
// {
//     public function index()
//     {
//         return Lead::all();  // For simplicity, returning all leads.
//     }

//     public function store(Request $request)
//     {
//         // Validate incoming request
//         // $request->validate([
//         //     'name' => 'required|string|max:255',
//         //     'email' => 'required|email|unique:leads,email',
//         //     'contact_number' => 'required|string|max:15',  // Add validation for contact_number
//         // ]);

//         $lead = Lead::create([
//             'name' => $request->name,
//             'contact_number' => $request->contact_number,
//             'email' => $request->email,
//             'status' => $request->status, // Store role in database
//             'assigned_to' => $request->assigned_to, // Store role in database            
//         ]);

//         return response()->json($lead, 201);
//     }

//     // public function store(Request $request)
//     // {
//     //     $request->validate([
//     //         'title' => 'required|string|max:255',
//     //         'description' => 'required|string|max:255',
//     //     ]);

//     //     $todo = Todo::create([
//     //         'title' => $request->title,
//     //         'description' => $request->description,
//     //     ]);

//     //     return response()->json([
//     //         'status' => 'success',
//     //         'message' => 'Todo created successfully',
//     //         'todo' => $todo,
//     //     ]);
//     // }    
//     public function update(Request $request, $id)
//     {
//         $lead = Lead::find($id);
//         $lead->update($request->all());
//         return response()->json($lead);
//     }
// }
