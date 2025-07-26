@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="w-full max-w-2xl bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">🎮 My Dashboard</h1>

        <div class="space-y-4">
            <form action="{{ route('auth.reset-token', ['token' => request('token')]) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded text-lg">
                    🔄 Generate New Access Link
                </button>
            </form>

            <form action="{{ route('auth.deactivate-token', ['token' => request('token')]) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded text-lg">
                    ❌ Deactivate Current Link
                </button>
            </form>

            <form action="{{ route('dashboard.play', ['token' => request('token')]) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-4 rounded text-lg">
                    🍀 I'm Feeling Lucky
                </button>
            </form>

            @isset($gameResult)
                <div class="mt-4 p-4 bg-gray-100 rounded text-center">
                    <p class="text-lg">🎯 Amount: <strong>{{ $gameResult->amount }}</strong></p>
                    <p class="mt-1">
                        💰 Result:
                        <strong class="{{ $gameResult->isWin() ? 'text-green-600' : 'text-red-600' }}">
                            {{ $gameResult->isWin() ? 'You Win!' : 'You Lose' }}
                        </strong>
                    </p>
                </div>
            @endisset

            <a href="{{ route('dashboard.history', ['token' => request('token')]) }}"
               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded text-lg">
                📜 View History
            </a>

            @if(isset($history) && $history->count())
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">📊 Game History</h2>

                    <div class="space-y-2">
                        @foreach($history as $item)
                            <div class="flex justify-between items-center bg-gray-50 px-4 py-2 rounded shadow-sm">
                    <span class="{{ $item->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $item->amount > 0 ? 'You Win!' : 'You Lose' }}
                    </span>
                                <span class="text-gray-800 font-medium">
                        💰 {{ number_format($item->amount, 2) }}
                    </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
