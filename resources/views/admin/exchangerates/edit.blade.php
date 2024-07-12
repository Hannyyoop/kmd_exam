@extends('layouts.master')

@section('content')
    <section class="bg-white w-full dark:bg-gray-900">
        <div class="px-4 mx-auto lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Exchange Rate Edit Form</h2>
            <form action="{{ route('exchangerates.update', $exchangerate->id) }}" method="post">
                @csrf @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code
                        </label>
                        <input type="text" name="code" id="code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('code') border-red-500 @enderror"
                            placeholder="Enter Code" value="{{ old('code', $exchangerate->code) }}" required="">
                        @error('code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="rate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rate</label>
                        <input type="number" name="rate" id="rate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('name') border-red-500 @enderror"
                            placeholder="Enter Exchange Rate" value="{{ old('rate', $exchangerate->rate) }}" required="">
                        @error('rate')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
