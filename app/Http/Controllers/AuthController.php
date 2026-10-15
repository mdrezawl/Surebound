<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show Agent/User Login Form
     */
    public function showLogin()
    {
        try {
            if (Auth::check()) {
                return Auth::user()->role === 'user'
                    ? redirect()->route('dashboard')
                    : redirect()->route('admin.dashboard');
            }
        } catch (\Throwable $e) {
            // Silently allow rendering login page even if DB is not initialized yet
        }

        return view('auth.login');
    }

    /**
     * Handle Login Submission
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        try {
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                $user = Auth::user();

                if ($user->role === 'user') {
                    return redirect()->intended(route('dashboard'))
                        ->with('success', 'Welcome back, '.$user->name.'!');
                }

                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back, '.$user->name.'!');
            }
        } catch (\Throwable $e) {
            return back()->withErrors([
                'email' => 'Database connection error: '.$e->getMessage().' (Please check .env DB credentials or visit /setup to configure database)',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show Registration Form
     */
    public function showRegister()
    {
        try {
            if (Auth::check()) {
                return Auth::user()->role === 'user'
                    ? redirect()->route('dashboard')
                    : redirect()->route('admin.dashboard');
            }
        } catch (\Throwable $e) {
            // Silently allow rendering register page even if DB is not initialized yet
        }

        return view('auth.register');
    }

    /**
     * Check if email format is valid and whether it already exists in the database
     */
    public function checkEmail(Request $request)
    {
        $email = trim((string) ($request->input('email') ?? $request->query('email', '')));

        if ($email === '') {
            return response()->json([
                'valid' => false,
                'available' => false,
                'reason' => 'empty',
                'message' => 'Please enter an email address.',
            ], 422);
        }

        // Basic format and domain extension verification
        $hasValidFormat = filter_var($email, FILTER_VALIDATE_EMAIL) !== false
            && preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);

        if (! $hasValidFormat) {
            return response()->json([
                'valid' => false,
                'available' => false,
                'reason' => 'format',
                'message' => 'Invalid email format. Please enter a valid email address (e.g. name@example.com).',
            ]);
        }

        // Check if email already exists in users database
        $exists = User::where('email', strtolower($email))->exists();

        if ($exists) {
            return response()->json([
                'valid' => true,
                'available' => false,
                'reason' => 'exists',
                'message' => 'This email is already registered. Please sign in or use a different email.',
            ]);
        }

        return response()->json([
            'valid' => true,
            'available' => true,
            'reason' => 'available',
            'message' => 'Email is valid and available for registration.',
        ]);
    }

    /**
     * Handle Customer / User Registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,filter', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'title' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ], [
            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please provide a valid email format (e.g. name@example.com).',
            'email.unique' => 'This email address is already registered. Please sign in or use a different email.',
        ]);

        if ($request->filled(['math_num1', 'math_num2', 'math_answer'])) {
            $expected = (int) $request->input('math_num1') + (int) $request->input('math_num2');
            if ((int) $request->input('math_answer') !== $expected) {
                return back()->withErrors([
                    'math_answer' => 'Security verification failed: math calculation was incorrect.',
                ])->withInput();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'title' => $validated['title'] ?? 'Policyholder',
            'phone' => $validated['phone'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Your account has been created successfully! Welcome to your Surebound customer portal.');
    }

    /**
     * Handle Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('info', 'You have been safely signed out of your portal.');
    }
}
