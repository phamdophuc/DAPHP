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

/* Button styling */
button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background-color: #c82333;
}

/* Modal styling */
.x-modal {
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
}

.x-modal[open] {
    display: flex;
}

.x-modal .p-6 {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
}

.x-modal h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
}

.x-modal p {
    font-size: 0.875rem;
    color: #666;
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

/* Validation error styling */
.x-input-error {
    font-size: 0.875rem;
    color: #d9534f;
    margin-top: 8px;
}

/* Button spacing in modal */
.ms-3 {
    margin-left: 12px;
}

/* Flex container for the modal buttons */
.mt-6.flex {
    display: flex;
    justify-content: flex-end;
}
</style>
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Xóa tài khoản') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của nó sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào mà bạn muốn giữ lại.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Xóa tài khoản') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Bạn có chắc chắn muốn xóa tài khoản không?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của nó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận bạn muốn xóa tài khoản vĩnh viễn.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mật khẩu') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Mật khẩu') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Hủy') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Xóa tài khoản') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
