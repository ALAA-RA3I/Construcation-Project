<?php

namespace App\Http\Controllers\View;

use App\Domain\Services\BaseServices\Contracts\ClientAuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\LoginWebRequest;
use App\Http\Requests\ClientRequests\RegisterClientRequest;
use Illuminate\Http\Request;

class ClientWebController extends Controller
{
    protected $clientService;
    public function __construct(
        ClientAuthServiceInterface $clientService
    ) {
        $this->clientService = $clientService;
    }

    public function showLoginForm(Request $request)
    {
        // Store the redirect URL in session if it exists in the request
        if ($request->has('redirect')) {
            session(['url.intended' => $request->redirect]);
        }
        return view('auth.login');
    }

    public function login(LoginWebRequest $request)
    {
        $credentials = $request->validated();

        if ($this->clientService->webLogin($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended URL or home as fallback
            return redirect()->intended('/')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm(Request $request)
    {
        // Store the redirect URL in session if it exists in the request
        if ($request->has('redirect')) {
            session(['url.intended' => $request->redirect]);
        }
        return view('auth.register');
    }

    public function register(RegisterClientRequest $request)
    {
        $userData = $request->validated();
        $user = $this->clientService->register($userData);

        auth()->guard('client')->login($user);

        // Redirect to intended URL or home as fallback
        return redirect()->intended('/')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        $this->clientService->webLogout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
