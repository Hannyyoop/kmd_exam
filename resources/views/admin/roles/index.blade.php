@extends('layouts.master')
@section('content')
    <div class="px-4 py-4 sm:px-6 lg:px-8 bg-white shadow rounded-lg mb-5 mx-3">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-bold leading-6 text-gray-900">Role List</h1>
            </div>
            <div class="mt-4 flex space-x-2 justify-end">
                {{-- <form action="{{ url('admin/search-users') }}" method="GET">
                    @csrf
                    <input type="text" name="search" id="search"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-dark-600 sm:text-sm sm:leading-6"
                        placeholder="Search">
                </form> --}}

                <form action="{{ route('roles.index') }}" method="get" class="w-64 mx-auto">

                    <div class="flex">
                        <div class="relative w-full">

                            <input type="text" id="location-search" name="keyword"
                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                placeholder="Search"
                                @if (request()->has('keyword')) value="{{ request()->keyword }}" @endif />

                            <button type="submit"
                                class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white bg-[#002D74] rounded-r-lg border border-[#002D74] hover:bg-[#005BB5] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('roles.create') }}"
                        class="flex items-center rounded-md bg-[#002D74] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#005BB5] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Role
                    </a>
                @endif
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full table-fixed">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pl-0">#</th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Name
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Permission
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pr-0">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white font-medium">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->index + 1 }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm">
                                        {{ $role->name }}
                                    </td>

                                    <td class="whitespace-nowrap p-4 text-sm">
                                        <ol class="list-none space-y-2">
                                            @foreach ($role->permissions as $permission)
                                                <li
                                                    class="items-center rounded-full bg-blue-100 w-32 px-2 py-1 text-xs font-medium text-blue-700">
                                                    {{ $permission->name }}
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm sm:pr-0 flex space-x-3">
                                        @if (auth()->user()->hasRole('Admin'))
                                            <a href="{{ route('roles.edit', $role->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="w-6 h-6 text-[#002D74] flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                    <path
                                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                </svg>
                                                Edit
                                            </a>


                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                @csrf @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure to delete this?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6 text-red-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    Del
                                                </button>
                                            </form>


                                            <a href="{{ route('roles.assignPermissionIndex', $role->id) }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-yellow-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>

                                                Permission
                                            </a>
                                        @else
                                            <div class="flex items-center">
                                                <p class="text-xs text-red-500">Permission required</p>
                                            </div>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
