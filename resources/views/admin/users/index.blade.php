@extends('layouts.master')
@section('content')
    <div class="px-4 py-4 sm:px-6 lg:px-8 bg-white shadow rounded-lg mb-5 mx-3">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-bold leading-6 text-gray-900">User List</h1>
            </div>
            <div class="mt-4 flex space-x-2 justify-end">
                <form action="{{ url('admin/search-users') }}" method="GET">
                    <input type="text" name="search" id="search"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Search🔍">
                </form>
                <a href="{{ route('users.create') }}"
                    class="flex rounded-md bg-[#0040FF] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#0059FF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add
                </a>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr class="divide-x divide-gray-200">
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pl-0">#</th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Name
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Center
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Email
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">
                                    Role
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pr-0">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white font-medium">
                            @foreach ($users as $user)
                                <tr class="divide-x divide-gray-200">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm">
                                        {{ $user->name }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm">
                                        @if ($user->centers)
                                            @foreach ($user->centers as $center)
                                                <span class="badge badge-accent text-white font-semibold">
                                                    {{ $center->code }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap p-4 text-sm">
                                        {{ $user->email }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm">
                                        @foreach ($user->getRoleNames() as $role)
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">
                                                {{ $role }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm sm:pr-0 flex space-x-3">
                                        @if ($user->deleted_at == null)
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="w-6 h-6 text-cyan-700 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                    <path
                                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="{{ route('users.assignRoleIndex', $user->id) }}"
                                                class="text-yellow-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                                </svg>
                                                Role
                                            </a>
                                            <button type="submit"
                                                onclick="document.getElementById('deleteModal{{ $user->id }}').showModal()"
                                                class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Del
                                            </button>
                                        @else
                                            This user is deleted.
                                        @endif
                                    </td>
                                </tr>

                                {{-- Delete Modal --}}
                                <dialog id="deleteModal{{ $user->id }}" class="modal">
                                    <div class="relative z-10" aria-labelledby="modal-title" role="dialog"
                                        aria-modal="true">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                            <div
                                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div
                                                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                                    <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                                                        <button type="button"
                                                            onclick="document.getElementById('deleteModal{{ $user->id }}').close()"
                                                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="sm:flex sm:items-start">
                                                        <div
                                                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg class="h-6 w-6 text-red-600" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                            <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                                id="modal-title">Delete user</h3>
                                                            <div class="mt-2">
                                                                <p class="text-sm text-gray-500">Are you sure you want to
                                                                    delete the user? The deleted user will be moved
                                                                    to trash.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                                                            <button type="button"
                                                                onclick="document.getElementById('deleteModal{{ $user->id }}').close()"
                                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dialog>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
