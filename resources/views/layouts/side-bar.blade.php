<div class="h-full px-3 py-4 overflow-auto bg-gray-50 dark:bg-gray-800">
    {{-- @php
        $url = url()->current();
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', $path);
        $lastTwoSegments = implode('/', array_slice($segments, -2));

        function conditions($permission)
        {
            $roles = Spatie\Permission\Models\Role::pluck('name')->toArray();
            if (
                auth()->user()->hasAnyRole($roles) &&
                auth()
                    ->user()
                    ->hasAnyPermission(['All Feature', $permission])
            ) {
                return true;
            }
            return false;
        }
    @endphp --}}
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <ul class="space-y-2">
        <h2 class="space-y-2 pt-2 font-bold">User & Role</h2>

        <ul>

            <li>
                <a href="{{ route('users.index') }}"
                    class="flex items-center p-2 rounded-lg group
                    {{ $currentRoute === 'users.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 transition duration-75
                    {{ $currentRoute === 'users.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>

                    <span class="ms-3">User</span>
                </a>
            </li>

            <li>
                <a href="{{ route('roles.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ $currentRoute === 'roles.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 transition duration-75
                    {{ $currentRoute === 'roles.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>

                    <span class="ms-3">Role</span>
                </a>
            </li>
            <h2 class="space-y-2 pt-2 font-bold">Master</h2>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"

                        xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Media & Services</span>
                    <svg class="w-3 h-3 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('media.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group {{ $currentRoute === 'media.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }}">Media</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="{{ route('centers.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group {{ $currentRoute === 'centers.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 transition duration-75
                    {{ $currentRoute === 'centers.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Center</span>

                </a>
            </li>
            <li>
                <a href="{{ route('subincomeexpenses.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{ $currentRoute === 'subincomeexpenses.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }} group">

                    <svg class="w-5 h-5 transition duration-75 {{ $currentRoute === 'subincomeexpenses.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Sub Income/Expense</span>

                </a>
            </li>
            <li>
                <a href="{{ route('exchangerates.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{ $currentRoute === 'exchangerates.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }} group">
                    <svg class="w-5 h-5 transition duration-75 {{ $currentRoute === 'exchangerates.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Exchange Rate</span>
                </a>
            </li>
            <li>
                <a href="{{ route('servicetypes.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{ $currentRoute === 'servicetypes.index' ? 'bg-[#1769B5] text-white' : 'text-gray-900 dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700' }} group">
                    <svg class="w-5 h-5 transition duration-75 {{ $currentRoute === 'servicetypes.index' ? 'text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                      </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Service Type</span>
                </a>
            </li>
            <h2 class="space-y-2 pt-2 font-bold">Exam Payment</h2>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example-1" data-collapse-toggle="dropdown-example-1">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                      </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Exam Fee</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example-1" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-300 dark:text-white dark:hover:bg-gray-700">Exam
                            Fee Payment</a>
                    </li>

                </ul>
            </li>
            <h2 class="space-y-2 pt-2 font-bold">Reporting</h2>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example-3" data-collapse-toggle="dropdown-example-3">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                      </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Report Exam Payments</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example-3" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-300 dark:text-white dark:hover:bg-gray-700">Exam
                            Fee Payment Report</a>
                    </li>

                </ul>
            </li>
        </ul>
    </ul>

</div>
