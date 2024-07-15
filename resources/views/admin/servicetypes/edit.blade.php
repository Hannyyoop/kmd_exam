@extends('layouts.master')

@section('content')
    <section class="bg-white w-full dark:bg-gray-900">
        <div class="px-4 mx-auto lg:py-8">
             <div class="flex justify-end">
                    <a href="{{ route('servicetypes.index') }}" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>

                    </a>
                </div>
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Service Type</h2>
            <form action="{{ route('servicetypes.update', $servicetype->id) }}" method="post">
                @csrf @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service
                            Type Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('name') border-red-500 @enderror"
                            placeholder="Service Type Name" value="{{ old('name', $servicetype->name) }}" required="">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="fee"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fee</label>
                        <input type="number" name="fee" id="fee"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('name') border-red-500 @enderror"
                            placeholder="Enter Fee" value="{{ old('fee', $servicetype->fee) }}" required="">
                        @error('fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="sm:col-span-2">
                        <label for="rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Currency Code</label>
                        <select id="rate" name="exchangerate_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Choose Currency</option>
                            @foreach ($exchangerates as $exchangerate)
                                <option value="{{ $exchangerate->id }}" @if ($servicetype->exchangerate_id == $exchangerate->id) selected @endif>
                                    {{ $exchangerate->code }} ({{ $exchangerate->rate }})</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="grid justify-items-end">
                    <div class="flex space-x-2">

                        <button type="submit"
                            class="btn text-white bg-[#002D74] my-3 btn-sm hover:bg-[#001F56]">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
