<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    public function login(Request $request)
    {

        $data = $request->only('email', 'password');

        // Retrieve the user from the database using their email and password
        $user = User::where('email', $data['email'])
            ->where('password', $data['password'])
            ->first();

        // Check if the user exists
        if ($user) {
            return response($user);
        }

        // User not found, return error response
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    
    public function verifyemail(Request $request)
    {
        $data = $request->only('email');
    
        // Retrieve the user from the database using their email and password
        $user = User::where('email', $data['email'])->first();
    
        if ($user) {
            return response()->json(['exists' => true]);
        }
    
        // User not found
        return response()->json(['exists' => false]);
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Create the user record
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'Ftype' => $data['type'],
            'password' => $data['password'],
            'country' => $data['country'],
            'role' => $data['role'],
            'bio' => $data['bio'],
            'hourly_rate' => $data['hourly_rate'],
            'languages' => json_encode($data['languages']),
            'skills' => json_encode($data['skills']), // Assuming $data['skills'] is an array
            'experience' => $data['experience'],
            'profile_photo' => $data['profile_photo'],
            'level' => $data['level']
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
