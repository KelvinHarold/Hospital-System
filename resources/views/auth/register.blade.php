<x-guest-layout>
    <div class="flex flex-col items-center justify-center">
        <div class="bg-white shadow-xl rounded-xl w-full sm:max-w-md p-8 space-y-6">

            <!-- Logo + Title -->
            <div class="flex flex-col items-center space-y-2">
                <x-application-logo class="w-16 h-16 text-indigo-600" />
                <h2 class="text-2xl font-bold text-indigo-700">Register to MtotoClinic</h2>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                                  type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
