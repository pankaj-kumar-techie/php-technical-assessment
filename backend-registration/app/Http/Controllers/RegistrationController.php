<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]+$/', // Only letters and numbers
                'min:3',
                'max:20',
                'unique:users,name'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // At least one lowercase, uppercase, and number
            ],
        ]);

        // If validation fails, log it and redirect back
        if ($validator->fails()) {
            Log::warning('User registration validation failed', [
                'errors' => $validator->errors()->toArray(),
                'ip_address' => $request->ip(),
            ]);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create the new user
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log successful
            Log::info('New user registered', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip_address' => $request->ip(),
            ]);

            // Redirect to home with success message
            return redirect('/')->with('success', 'Welcome! Your account has been created successfully.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to create user account', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'ip_address' => $request->ip(),
            ]);

            // Return with error message
            return back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }
    }
}
