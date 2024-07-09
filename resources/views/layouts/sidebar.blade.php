<div class="flex-1 px-3 bg-white divide-y space-y-1">
    @php
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
    @endphp

    <ul class="space-y-2 pb-2">

        <ul class="space-y-2 py-1">
            <h4 class="px-2 font-bold text-black">User and Role</h4>

            <li class="font-medium">
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="user-role" data-collapse-toggle="user-role">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-sm text-left rtl:text-right whitespace-nowrap">User & Role</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="user-role" class="py-2 space-y-2 @if ($lastTwoSegments !== '#' && $lastTwoSegments !== '#') hidden @endif">
                    <li>
                        <a href="{{ url('admin/users') }}"
                            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white
                        @if ($lastTwoSegments == 'admin/users') bg-blue-500 text-white hover:bg-blue-700 @endif">Users</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/roles') }}"
                            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white
                        @if ($lastTwoSegments == 'admin/roles') bg-blue-500 text-white hover:bg-blue-700 @endif">Roles</a>
                    </li>
                </ul>
            </li>
        </ul>


        <ul class="space-y-2 py-1">
            <h4 class="px-2 font-bold text-black">Masters</h4>
            <li class="font-medium">
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="media-service" data-collapse-toggle="media-service">
                    <svg class="w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ms-3 text-sm text-left rtl:text-right whitespace-nowrap">Media and
                        Services</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="media-service" class="hidden py-2 space-y-2">
                    @if (conditions('Media'))
                        <li>
                            <a href="{{ url('admin/medias') }}"
                                class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white {{ request()->is('admin/medias') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">Media</a>
                        </li>
                    @endif
                    {{-- @if (conditions('center'))
                    <li>
                        <a href="{{ url('admin/departments') }}"
                            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Department</a>
                    </li>
                @endif --}}
                </ul>
            </li>
            @if (conditions('Center'))
                <li>
                    <a href="{{ url('admin/centers') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-700 hover:text-white {{ request()->is('admin/centers') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Center</span>
                    </a>
                </li>
            @endif
            @if (conditions('SubIncome Expenses'))
                <li>
                    <a href="{{ url('admin/subincomeexpenses') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-700 hover:text-white {{ request()->is('admin/subincomeexpenses') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path
                                d="M96 96V320c0 35.3 28.7 64 64 64H576c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160c-35.3 0-64 28.7-64 64zm64 160c35.3 0 64 28.7 64 64H160V256zM224 96c0 35.3-28.7 64-64 64V96h64zM576 256v64H512c0-35.3 28.7-64 64-64zM512 96h64v64c-35.3 0-64-28.7-64-64zM288 208a80 80 0 1 1 160 0 80 80 0 1 1 -160 0zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V360c0 66.3 53.7 120 120 120H520c13.3 0 24-10.7 24-24s-10.7-24-24-24H120c-39.8 0-72-32.2-72-72V120z" />
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Sub Income/Expense</span>
                    </a>
                </li>
            @endif
            @if (conditions('ExchangeRates'))
                <li>
                    <a href="{{ url('admin/exchangerates') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-700 hover:text-white {{ request()->is('admin/exchangerates') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Exchange Rate</span>
                    </a>
                </li>
            @endif
            @if (conditions('Service Types'))
                <li>
                    <a href="{{ url('admin/servicetypes') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-700 hover:text-white {{ request()->is('admin/servicetypes') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6">
                            <path
                                d="M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z" />
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Service Type</span>
                    </a>
                </li>
            @endif


        </ul>



        @if (conditions('Exam-Voucher'))
            <ul class="space-y-2 py-1">
                <h4 class="px-2 font-bold text-black">ExamPayment</h4>
                <li class="font-medium">
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="exam-fee-payment" data-collapse-toggle="exam-fee-payment">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ms-3 text-sm text-left rtl:text-right whitespace-nowrap">ExamFee &
                            In/Exp</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="exam-fee-payment" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ url('admin/examfeepayments') }}"
                                class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white {{ request()->is('admin/examfeepayments') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">ExamFees
                                Payment</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/incomeexpenses') }}"
                                class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white {{ request()->is('admin/incomeexpenses') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">Income
                                / Expense</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif

        @if (conditions('Reporting'))
            <ul class="space-y-2 py-1">
                <h4 class="px-2 font-bold text-black">Reporting</h4>
                <li class="font-medium">
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                        aria-controls="reporting" data-collapse-toggle="reporting">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6"
                            class="w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-sm text-left rtl:text-right whitespace-nowrap">Report
                            ExamPayments</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="reporting" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ url('admin/exam-fee-report') }}"
                                class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white {{ request()->is('admin/exam-fee-report') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">ExamFees
                                Payment</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/income-expense-report') }}"
                                class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-blue-700 hover:text-white {{ request()->is('admin/income-expense-report') ? 'bg-blue-500 text-white hover:bg-blue-700' : '' }}">Income
                                & Expense</a>
                        </li>
                    </ul>
                </li>

            </ul>
        @endif
</div>
