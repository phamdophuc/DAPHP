<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Hiển thị thông báo thành công --}}
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Cập nhật thông tin cá nhân --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition duration-300 hover:shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Đổi mật khẩu --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition duration-300 hover:shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Xóa tài khoản --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition duration-300 hover:shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
