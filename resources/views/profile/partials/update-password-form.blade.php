<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Nhập mật khẩu hiện tại --}}
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input 
                id="current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full" 
                required 
                autocomplete="current-password" 
            />
            @error('current_password')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nhập mật khẩu mới --}}
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input 
                id="password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full" 
                required 
                autocomplete="new-password" 
            />
            @error('password')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Xác nhận lại mật khẩu --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full" 
                required 
                autocomplete="new-password" 
            />
            @error('password_confirmation')
                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nút lưu và thông báo cập nhật --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition.opacity.duration.500ms
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >
                    {{ __('Password updated successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
