<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-base font-medium">
                        {{ __('FashionShop') }}
                    </x-nav-link>
                </div>
            </div>

            @auth
            @if (Gate::allows('admin'))
                <div class="flex space-x-4 items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <span class="font-semibold text-gray-900 dark:text-gray-100 text-base">Sản Phẩm</span>
                                <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('products.create')" class="text-sm">
                                Thêm Sản Phẩm
                            </x-dropdown-link>     
                        </x-slot>
                    </x-dropdown>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <span class="font-semibold text-gray-900 dark:text-gray-100 text-base">Danh Mục</span>
                                <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('categories.create')" class="text-sm">
                                Thêm Danh Mục
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('categories.index')" class="text-sm">
                                Xem Danh Mục
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <span class="font-semibold text-gray-900 dark:text-gray-100 text-base">Thương Hiệu</span>
                                <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('brands.create')" class="text-sm">
                                Thêm Thương Hiệu
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('brands.index')" class="text-sm">
                                Xem Thương Hiệu
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif
            <div class="flex items-center space-x-4">
                <a href="{{ route('cart.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white flex items-center text-sm font-medium">
                    🛒 <span class="ml-1">Giỏ hàng</span>
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="text-base">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-sm">
                            {{ __('Thông tin cá nhân') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('orders.index')" class="text-sm">
                            {{ __('Lịch sử đơn hàng') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('order-details.index')" class="text-sm">
                            {{ __('Chi tiết đơn hàng') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm">
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 px-4 py-2 text-sm font-medium">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 px-4 py-2 text-sm font-medium">
                    {{ __('Register') }}
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>
