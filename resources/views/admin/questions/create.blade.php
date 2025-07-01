<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Quiz Question
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops! There was a validation error.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Add Question Form --}}
                    <form action="{{ route('admin.questions.store') }}" method="POST">
                        @csrf

                        {{-- Question Text --}}
                        <div class="mb-4">
                            <label for="question_text" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Question Text:</label>
                            <textarea name="question_text" id="question_text" rows="3" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline">{{ old('question_text') }}</textarea>
                        </div>
                        
                        <!-- Select Material Dropdown -->
                        <div class="mb-4">
                            <label for="materi_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Select Material:</label>
                            <select name="materi_id" id="materi_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600" required>
                                <option value="">-- Select Related Material --</option>
                                @foreach($materis as $materi)
                                    <option value="{{ $materi->id }}">{{ $materi->title }}</option> {{-- Assuming the material title column is 'title' --}}
                                @endforeach
                            </select>
                        </div>

                        {{-- Option A --}}
                        <div class="mb-4">
                            <label for="option_a" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Option A:</label>
                            <input type="text" name="option_a" id="option_a" value="{{ old('option_a') }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600">
                        </div>

                        {{-- Option B --}}
                        <div class="mb-4">
                            <label for="option_b" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Option B:</label>
                            <input type="text" name="option_b" id="option_b" value="{{ old('option_b') }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600">
                        </div>

                        {{-- Option C --}}
                        <div class="mb-4">
                            <label for="option_c" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Option C:</label>
                            <input type="text" name="option_c" id="option_c" value="{{ old('option_c') }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600">
                        </div>

                        {{-- Option D --}}
                        <div class="mb-4">
                            <label for="option_d" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Option D:</label>
                            <input type="text" name="option_d" id="option_d" value="{{ old('option_d') }}" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600">
                        </div>

                        {{-- Correct Answer --}}
                        <div class="mb-4">
                            <label for="correct_answer" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Correct Answer:</label>
                            <select name="correct_answer" id="correct_answer" required
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600">
                                <option value="a" {{ old('correct_answer') == 'a' ? 'selected' : '' }}>A</option>
                                <option value="b" {{ old('correct_answer') == 'b' ? 'selected' : '' }}>B</option>
                                <option value="c" {{ old('correct_answer') == 'c' ? 'selected' : '' }}>C</option>
                                <option value="d" {{ old('correct_answer') == 'd' ? 'selected' : '' }}>D</option>
                            </select>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save Question
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>