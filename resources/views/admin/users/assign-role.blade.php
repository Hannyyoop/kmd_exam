@extends('layouts.master')

@section('content')
    {{-- <x-flash-message /> --}}

    <form action="{{ route('users.assignRole', $user->id) }}" method="post">
        @csrf
        <div class="p-6 px-4">
            <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">

                <div class="grid grid-cols-6 gap-4 mb-3">
                    <div class="col-start-1 col-end-3">
                        <h5 class="card-title text-bold text-black">Role List</h5>
                        <h6 class="text-gray-800"><span class="font-bold">User:</span> {{ $user->name }}</h6>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                    <div class="col-end-9 col-span-2">
                        <a href="{{ route('users.index') }}" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                            </svg>

                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">#</th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Role</th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-sm text-black text-semibold">
                                        {{ $role->id }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm text-black text-semibold">
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        <input type="checkbox" name="role_ids[]" value="{{ $role->id }}"
                                            class="w-4 h-4 text-black bg-gray-100 border-black-300 rounded focus:ring-black dark:bg-gray-700 dark:border-gray-600 checked:bg-black checked:border-black checked:ring-black"
                                            @foreach ($user->roles as $userRole)
                                        @if ($role->id === $userRole->id)
                                            checked = "checked"
                                        @endif @endforeach>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="grid justify-items-end mt-5">
                    <div class="flex space-x-2">
                        <button type="submit" class="btn text-white bg-[#002D74] my-3 btn-sm hover:bg-[#001F56]">Assign
                            Role</button>
                    </div>
                </div>

            </div>
    </form>

    </div>
@endsection
