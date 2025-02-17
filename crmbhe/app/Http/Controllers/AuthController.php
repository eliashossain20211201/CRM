<?php
// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

// use Validator;

// class AuthController extends Controller
// {
//     // Register a user (Admin or Counselor)
//     public function register(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|string|min:6',
//             'role' => 'required|in:admin,counselor', // Role is passed here
//         ]);

//         if ($validator->fails()) {
//             return response()->json(['error' => $validator->errors()], 400);
//         }

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => bcrypt($request->password),
//             'role' => $request->role, // Store role in database
//         ]);

//         return response()->json(['message' => 'User registered successfully'], 201);
//     }

//     // Login user and generate JWT token
//     public function login(Request $request)
//     {
//         $credentials = $request->only('email', 'password');

//         if ($token = JWTAuth::attempt($credentials)) {
//             return response()->json(['token' => $token]);
//         }

//         return response()->json(['error' => 'Unauthorized'], 401);
//     }

//     // Get the authenticated user's details
//     public function user(Request $request)
//     {
//         return response()->json(auth()->user());
//     }
// }




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // Apply JWT middleware except for login & register
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = JWTAuth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,counselor',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => JWTAuth::user(),
            'authorisation' => [
                'token' => JWTAuth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
