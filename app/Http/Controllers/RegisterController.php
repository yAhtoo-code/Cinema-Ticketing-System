<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([  // Validate the incoming request data
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        
        $user = new User();  // Create a new user
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        if ($user){
            $user_details = new UserDetail();
            $user_details->user_id = $user->id;
            $user_details->full_name = $validatedData['full_name'];
            $user_details->phone_number = $validatedData['phone_number'];
            $user_details->save();
        }
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');  // Redirect to login page with success message
    }
}
