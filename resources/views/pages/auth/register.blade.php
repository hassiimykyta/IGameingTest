@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>

        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <div class="mb-6">
                <label for="username" class="block text-base font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       class="mt-1 block w-full px-2 py-2 text-m rounded-md border @error('username') border-red-500 @else border-gray-300 @enderror shadow-sm focus:ring-blue-500 focus:border-blue-500" />

                @error('username')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-base font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                       class="mt-1 block w-full px-2 py-2 text-m rounded-md border @error('phone') border-red-500 @else border-gray-300 @enderror shadow-sm focus:ring-blue-500 focus:border-blue-500" />

                @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-3 px-4 rounded">
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
