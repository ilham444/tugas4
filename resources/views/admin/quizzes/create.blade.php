{{-- PASTE THIS ENTIRE CODE INTO: resources/views/admin/soal/create.blade.php --}}

<x-app-layout>
    {{-- Slot for Page Header --}}
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Add New Question
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                For Quiz: <span class="font-medium">{{ $quiz->title }}</span>
            </p>
        </div>
    </x-slot>

    {{-- Slot for Header Action Button (Example: Back Button) --}}
    <x-slot name="actions">
        <a href="{{ route('admin.quizzes.soal.index', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
            Back
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- This form will send data to AdminSoalController@store --}}
                    {{-- enctype="multipart/form-data" is REQUIRED for file uploads --}}
                    <form action="{{ route('admin.quizzes.soal.store', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Question Text -->
                        <div class="mb-6">
                            <label for="question_text" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Question Text</label>
                            <textarea name="question_text" id="question_text" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('question_text') }}</textarea>
                            @error('question_text')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Question Type & Media Upload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="type" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Media Type</label>
                                <select name="type" id="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="text" @selected(old('type') == 'text')>Text Only</option>
                                    <option value="video" @selected(old('type') == 'video')>Video</option>
                                    <option value="audio" @selected(old('type') == 'audio')>Audio</option>
                                </select>
                                @error('type')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="media" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Upload Media (if needed)</label>
                                <input type="file" name="media" id="media" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('media')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700 my-8">

                        <!-- Answer Options -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">Answer Options (Check the correct one)</label>
                            @error('correct_option')
                                <p class="text-sm text-red-600 dark:text-red-400 mb-2">{{ $message }}</p>
                            @enderror
                            
                            {{-- Loop to create 4 answer options --}}
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-4 mb-3">
                                    <input type="radio" name="correct_option" value="{{ $i }}" id="correct_option_{{ $i }}" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <input type="text" name="options[]" placeholder="Option {{ chr(65 + $i) }}" value="{{ old('options.'.$i) }}" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                </div>
                                @error('options.'.$i)
                                    <p class="text-sm text-red-600 dark:text-red-400 mb-2 ml-8">{{ $message }}</p>
                                @enderror
                            @endfor
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-8">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Save Question
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>