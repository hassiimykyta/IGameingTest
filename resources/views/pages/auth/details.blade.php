@extends('layouts.app')

@section('title', 'Your Access Link')

@section('content')
    <div class="w-full max-w-lg bg-white p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">🎉 Welcome!</h1>

        <p class="text-gray-700 mb-4">
            Here is your personal access link. It’s valid for <strong>7 days</strong>.
            After that, it will expire and you’ll need to request a new one.
        </p>

        <div class="bg-gray-100 border border-gray-300 rounded px-4 py-3 mb-4 break-all">
            <a href="{{route('dashboard.index') . '?token=' . urlencode($token)}}"
               class="text-blue-600 hover:underline">
                {{ route('dashboard.index') . '?token=' . urlencode($token) }}
            </a>
        </div>

        <p class="text-sm text-gray-500">
            Save this link somewhere safe — it’s your key to access the platform.
        </p>
    </div>
@endsection
