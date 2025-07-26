<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function index(): View
    {
        return view('pages.auth.register');
    }

    public function invalidToken(): View
    {
        return view('pages.auth.invalid-token');
    }

    public function details(Request $request, string $token): View
    {
        return view('pages.auth.details', ['token' => $token]);
    }

    public function register(RegisterUserRequest $request): RedirectResponse
    {
        $user = $this->authService->createUser(
            username: $request->username,
            phone: $request->phone
        );

        return redirect()->route('auth.details', ['token' => $user->token]);
    }

    public function resetToken(Request $request, string $token): RedirectResponse
    {
        $user = $this->authService->resetToken(token: $token);

        if (!$user) {
            return redirect()->route('auth.invalid-token');
        }

        return redirect()->route('auth.details', ['token' => $user->token]);
    }

    public function deactivateToken(Request $request, string $token): RedirectResponse
    {
        $user = $this->authService->deactivateToken(token: $token);

        if (!$user) {
            return redirect()->route('auth.invalid-token');
        }

        return redirect()->route('auth.index');
    }

}
