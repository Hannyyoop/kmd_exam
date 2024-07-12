@extends('layouts.master')

@section('content')
    <section class="bg-white w-full dark:bg-gray-900">
        <div class="px-4 mx-auto lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add Sub Income/Expense</h2>
            <form action="{{ route('subincomeexpenses.store') }}" method="post">
                @csrf
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub
                        Income/Expense</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('name') border-red-500 @enderror"
                        placeholder="Enter Name" value="{{ old('name') }}" required="">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid justify-items-start">
                    <div class="flex space-x-2">

                        <button type="submit"
                            class="btn text-white bg-[#002D74] my-3 btn-sm hover:bg-[#001F56]">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
