<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-[#6b46c1] dark:text-white" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-base font-semibold text-[#6b46c1] hover:text-purple-600 transition">
                        {{ __('FashionShop') }}
                    </x-nav-link>
                </div>
            </div>

            @auth
            @if (Gate::allows('admin'))
                <div class="flex space-x-4 items-center">
                    {{-- Sản phẩm --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-[#6b46c1] dark:text-purple-300 bg-white dark:bg-gray-800 hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none transition">
                                <span class="font-semibold text-base">Sản Phẩm</span>
                                <svg class="ml-2 h-4 w-4 text-[#6b46c1] dark:text-purple-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('products.create')" class="text-sm hover:text-[#6b46c1] transition">
                                ➕ Thêm Sản Phẩm
                            </x-dropdown-link>     
                        </x-slot>
                    </x-dropdown>

                    {{-- Danh mục --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-[#6b46c1] dark:text-purple-300 bg-white dark:bg-gray-800 hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none transition">
                                <span class="font-semibold text-base">Danh Mục</span>
                                <svg class="ml-2 h-4 w-4 text-[#6b46c1] dark:text-purple-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('categories.create')" class="text-sm hover:text-[#6b46c1] transition">
                                ➕ Thêm Danh Mục
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('categories.index')" class="text-sm hover:text-[#6b46c1] transition">
                                📂 Xem Danh Mục
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Thương hiệu --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-[#6b46c1] dark:text-purple-300 bg-white dark:bg-gray-800 hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none transition">
                                <span class="font-semibold text-base">Thương Hiệu</span>
                                <svg class="ml-2 h-4 w-4 text-[#6b46c1] dark:text-purple-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('brands.create')" class="text-sm hover:text-[#6b46c1] transition">
                                ➕ Thêm Thương Hiệu
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('brands.index')" class="text-sm hover:text-[#6b46c1] transition">
                                📂 Xem Thương Hiệu
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Người dùng --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-[#6b46c1] dark:text-purple-300 bg-white dark:bg-gray-800 hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none transition">
                                <span class="font-semibold text-base">Người Dùng</span>
                                <svg class="ml-2 h-4 w-4 text-[#6b46c1] dark:text-purple-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.index')" class="text-sm hover:text-[#6b46c1] transition">
                                👥 Danh sách người dùng
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            {{-- Giỏ hàng + User --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('cart.index') }}" class="text-[#6b46c1] hover:text-purple-600 dark:text-purple-300 flex items-center text-sm font-medium transition">
                    🛒 <span class="ml-1">Giỏ hàng</span>
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-[#6b46c1] dark:text-purple-300 bg-white dark:bg-gray-800 hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none transition">
                            <div class="text-base font-semibold">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-[#6b46c1]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-sm hover:text-[#6b46c1] transition">
                            {{ __('Thông tin cá nhân') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('orders.index')" class="text-sm hover:text-[#6b46c1] transition">
                            {{ __('Lịch sử đơn hàng') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('order-details.index')" class="text-sm hover:text-[#6b46c1] transition">
                            {{ __('Chi tiết đơn hàng') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm hover:text-red-500 transition">
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <a href="{{ route('login') }}" class="text-[#6b46c1] hover:text-purple-600 px-4 py-2 text-sm font-medium transition">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="text-[#6b46c1] hover:text-purple-600 px-4 py-2 text-sm font-medium transition">
                    {{ __('Register') }}
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>
