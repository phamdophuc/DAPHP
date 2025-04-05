<style>
   /* General section styling */
section {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

/* Header styling */
header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

header p {
    font-size: 0.875rem;
    color: #666;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

form .mt-6 {
    margin-top: 24px;
}

/* Input field styling */
input[type="password"] {
    width: 100%;
    padding: 10px 16px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
}

input[type="password"]:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Button styling */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Validation error styling */
.x-input-error {
    font-size: 0.875rem;
    color: #d9534f;
    margin-top: 8px;
}

/* Status message styling */
.x-status-message {
    font-size: 1rem;
    color: #28a745;
}
</style>
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cập nhật mật khẩu') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Đảm bảo tài khoản của bạn sử dụng mật khẩu dài và ngẫu nhiên để duy trì bảo mật.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mật khẩu hiện tại')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Mật khẩu mới')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Xác nhận mật khẩu')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu lại') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Đã lưu.') }}</p>
            @endif
        </div>
    </form>
</section>

