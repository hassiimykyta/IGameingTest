<?php

namespace App\Http\Services;

use App\Models\History;
use App\Models\User;
use Illuminate\Support\Collection;

class HistoryService
{
    private User $user;
    public function __construct(string $token)
    {
        $this->user = User::findByValidToken($token);
    }
    public function createHistoryRecord(float $amount): History
    {
       return $this->user->histories()->create(['amount' => $amount]);
    }

    public function getLastestHistoryRecords(): Collection
    {
        return $this->user->histories()->latest()->take(3)->get();
    }

}
