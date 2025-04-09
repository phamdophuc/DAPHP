<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto p-8 bg-white rounded-xl shadow-xl mt-10">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Đăng Nhập</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="text-lg text-gray-700" />
                <x-text-input id="email" class="block mt-2 w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" class="text-lg text-gray-700" />
                <x-text-input id="password" class="block mt-2 w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6 text-gray-700">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="remember_me" class="ml-2 text-sm">{{ __('Remember me') }}</label>
            </div>

           <!-- Login Button -->
        <div class="flex items-center justify-center">
            <x-primary-button class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition flex justify-center items-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-600">{{ __("Don't have an account?") }}</span>
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                {{ __('Register here') }}
            </a>
        </div>
    </div>
</x-guest-layout>
