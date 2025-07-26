<?php

namespace App\Http\Services;

use App\Models\User;

class AuthService
{

    public function createUser(string $username, string $phone): User
    {
        return User::create([
            'username' => $username,
            'phone' => $phone,
        ]);
    }

    public function resetToken(string $token): ?User
    {
        $user = User::findByValidToken($token);

        if (!$user) {
          return null;
        }

        $user->resetToken();
        $user->save();
        $user->refresh();

        return $user;
    }

    public function deactivateToken(string $token): ?User
    {
        $user = User::findByValidToken($token);

        if (!$user) {
            return null;
        }

        $user->deactivateToken();
        $user->save();
        $user->refresh();

        return $user;
    }

}
