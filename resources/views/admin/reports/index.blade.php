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

                <a href="{{ route('reports.export') }}"
                    class="flex items-center rounded-md bg-[#002D74] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#005BB5] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>

                    Export
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
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Payment
                                        Date
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Student
                                        Name
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Center
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Total
                                        Fee
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Payment
                                        Type
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Service
                                        Type
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">
                                        Exam Date
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-bold text-gray-900">Bank
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-left text-sm font-bold text-gray-900 sm:pr-0">Remark
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
                                            {{ $examfeepayment->exam_date }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->student_name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->center->name }}
                                        </td>


                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ number_format($examfeepayment->total)." MMK" }}
                                        </td>


                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->payment_type }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->serviceType->name }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->exam_date }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->bank_name ? $examfeepayment->bank_name : '-' }}
                                        </td>

                                        <td class="whitespace-nowrap p-4 text-sm">
                                            {{ $examfeepayment->remark }}
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
