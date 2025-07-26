@extends('layouts.app')

@section('title', 'Invalid Link')

@section('content')
    <div class="w-full max-w-lg bg-white p-8 rounded shadow text-center">
        <h1 class="text-3xl font-bold text-red-600 mb-4">⛔ Invalid or Expired Link</h1>

        <p class="text-gray-700 mb-4">
            The access link you used is either <strong>invalid</strong> or has <strong>expired</strong>.
        </p>

        <p class="text-sm text-gray-500">
            If you believe this is a mistake, please request a new link or try again later.
        </p>

        <a href="{{ url('/') }}" class="mt-6 inline-block text-blue-600 hover:underline font-medium">
            ← Back to Register page
        </a>
    </div>
@endsection
