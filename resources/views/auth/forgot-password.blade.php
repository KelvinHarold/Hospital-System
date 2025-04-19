<x-guest-layout>
    <!-- Logo with Link -->
    <div class="flex flex-col items-center space-y-2">
        <x-application-logo class="w-16 h-16 text-indigo-600" />
        <h2 class="text-2xl font-bold text-indigo-700">MtotoClinic</h2>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Password Reset Form -->
    <form method="POST" action="{{ route('password.email') }}" class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm mx-auto">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
