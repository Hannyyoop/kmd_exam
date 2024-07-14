@extends('layouts.master')
@section('content')
    <div class="px-4 py-4 sm:px-6 lg:px-8 bg-white shadow rounded-lg mb-5 mx-3">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-bold leading-6 text-gray-900">Exam Fee Payment List</h1>
            </div>
            <div class="mt-4 flex space-x-2 justify-end">
                {{-- <form action="{{ url('admin/search-users') }}" method="GET">
                    @csrf
                    <input type="text" name="search" id="search"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-dark-600 sm:text-sm sm:leading-6"
                        placeholder="Search">
                </form> --}}

                <form action="{{ route('examfeepayments.index') }}" method="get" class="w-64 mx-auto">
                    <div class="flex">
                        <div class="relative w-full">

                            <input type="text" name="keyword"
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

                <a href="{{ route('examfeepayments.create') }}"
                    class="flex items-center rounded-md bg-[#002D74] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#005BB5] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add New
                </a>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="relative overflow-x-auto">
                        <table class="min-w-full table-fixed">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pl-0">#</th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Voucher
                                        No.
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Student
                                        Name
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Phone
                                        No.
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Date
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Exam
                                        Date
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">
                                        Receptionist
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Service
                                        Type
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Center
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Total
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Payment
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Refund
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pr-0">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white font-medium">
                                @foreach ($examfeepayments as $examfeepayment)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">
                                            {{ $examfeepayment->id }}
                                        </td>
                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->voucher_no }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->student_name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->phone_no }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->date }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->exam_date }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ Auth()->user()->name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->serviceType->name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->center->name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->total }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->payment }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->refund }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm sm:pr-0 flex space-x-3">

                                            <a href="{{ route('examfeepayments.show', $examfeepayment->id) }}">
                                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                                </svg>

                                                Print
                                            </a>

                                            <a href="{{ route('examfeepayments.edit', $examfeepayment->id) }}"
                                                onclick="confirm('Are you sure to delete this?')">
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


                                            <form action="{{ route('examfeepayments.destroy', $examfeepayment->id) }}"
                                                method="post">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $examfeepayments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
