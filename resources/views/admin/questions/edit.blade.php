<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Quiz Question
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Display Errors If Any --}}
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

                    {{-- Update Question Form --}}
                    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Question --}}
                        <div class="mb-4">
                            <label for="question_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Question Text:</label>
                            <textarea name="question_text" id="question_text" rows="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('question_text', $question->question_text) }}</textarea>
                        </div>

                        {{-- Option A --}}
                        <div class="mb-4">
                            <label for="option_a" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option A:</label>
                            <input type="text" name="option_a" id="option_a" required
                                value="{{ old('option_a', $question->option_a) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 sm:text-sm">
                        </div>

                        {{-- Option B --}}
                        <div class="mb-4">
                            <label for="option_b" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option B:</label>
                            <input type="text" name="option_b" id="option_b" required
                                value="{{ old('option_b', $question->option_b) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 sm:text-sm">
                        </div>

                        {{-- Option C --}}
                        <div class="mb-4">
                            <label for="option_c" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option C:</label>
                            <input type="text" name="option_c" id="option_c" required
                                value="{{ old('option_c', $question->option_c) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 sm:text-sm">
                        </div>

                        {{-- Option D --}}
                        <div class="mb-4">
                            <label for="option_d" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option D:</label>
                            <input type="text" name="option_d" id="option_d" required
                                value="{{ old('option_d', $question->option_d) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 sm:text-sm">
                        </div>

                        {{-- Correct Answer --}}
                        <div class="mb-4">
                            <label for="correct_answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer:</label>
                            <select name="correct_answer" id="correct_answer" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-indigo-500 sm:text-sm">
                                <option value="">-- Select Answer --</option>
                                <option value="a" {{ old('correct_answer', $question->correct_answer) == 'a' ? 'selected' : '' }}>A</option>
                                <option value="b" {{ old('correct_answer', $question->correct_answer) == 'b' ? 'selected' : '' }}>B</option>
                                <option value="c" {{ old('correct_answer', $question->correct_answer) == 'c' ? 'selected' : '' }}>C</option>
                                <option value="d" {{ old('correct_answer', $question->correct_answer) == 'd' ? 'selected' : '' }}>D</option>
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Save Changes
                            </button>
                            <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>