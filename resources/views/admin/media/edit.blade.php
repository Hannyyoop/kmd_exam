@extends('layouts.master')

@section('content')
    <section class="bg-white w-full dark:bg-gray-900">
        <div class="px-4 mx-auto lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Media </h2>
            <form action="{{ route('media.update', $media->id) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="grid gap-4 sm:gap-6">
                    <div class="w-full">
                        <label for="media"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="media"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('title') border-red-500 @enderror"
                            placeholder="Enter Title" value="{{ old('title', $media->title) }}" required="">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('description') border-red-500 @enderror"
                            placeholder="Enter Description" required>{{ old('description', $media->description) }}</textarea>


                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a
                            new
                            image</label>
                        @if ($media->image)
                            <div class="mb-2">
                                <img src="{{ asset('medias/' . $media->image) }}" alt="image"
                                    class="max-w-32 rounded border border-black">
                            </div>
                        @endif

                        <input type="file" name="image" id="image"
                            class="file-input file-input-bordered w-full @error('image') border-red-500 @enderror" />
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid justify-items-start">
                        <div class="flex space-x-2">

                            <button type="submit"
                                class="btn text-white bg-[#002D74] my-3 btn-sm hover:bg-[#001F56]">Update</button>
                        </div>

                    </div>
            </form>
        </div>
        </div>
    </section>
@endsection
