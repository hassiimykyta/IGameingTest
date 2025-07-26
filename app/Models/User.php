<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'phone',
        'token',
        'token_expires_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'token_expires_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            $user->token = $user->generateToken();
            $user->token_expires_at = $user->generateTokenExpiredDate();
        });
    }

    public static function findByValidToken(string $token): ?self
    {
        return self::query()
            ->where('token', $token)
            ->where('token_expires_at', '>', now())
            ->first();
    }

    protected function generateToken(): string
    {
        return Str::random(40);
    }

    protected function generateTokenExpiredDate(): string
    {
        return Carbon::now()->addDays(7);
    }

    public function resetToken(): void
    {
        $this->token = $this->generateToken();
        $this->token_expires_at = $this->generateTokenExpiredDate();
    }

    public function deactivateToken(): void
    {
        $this->token_expires_at = Carbon::now();
    }

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
