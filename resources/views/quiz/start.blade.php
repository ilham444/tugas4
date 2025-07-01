<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Start Quiz') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Answer the questions below to test your knowledge.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    @if($questions->isEmpty())
                        <div class="text-center py-16 px-6">
                            <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-200">No Questions Available</h3>
                            <p class="mt-1 text-sm text-gray-500">There are no questions in this quiz yet. Please contact an administrator.</p>
                        </div>
                    @else
                        <form action="{{ route('quiz.submit') }}" method="POST">
                            @csrf
                            <div class="space-y-8">
                                @foreach($questions as $index => $question)
                                    <div class="p-6 border border-gray-200 dark:border-gray-700 rounded-lg">
                                        <p class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                                            <span class="text-indigo-600 dark:text-indigo-400">Question {{ $loop->iteration }}:</span> {{ $question->question_text }}
                                        </p>
                                        
                                        <div class="mt-4 space-y-3">
                                            @php
                                                $options = [
                                                    'a' => $question->option_a,
                                                    'b' => $question->option_b,
                                                    'c' => $question->option_c,
                                                    'd' => $question->option_d,
                                                ];
                                            @endphp

                                            @foreach ($options as $key => $value)
                                            <div>
                                                <label class="has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500 has-[:checked]:ring-2 has-[:checked]:ring-indigo-500 dark:has-[:checked]:bg-indigo-900/50 dark:has-[:checked]:border-indigo-500 group flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                    <input type="radio" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" name="answers[{{ $question->id }}]" value="{{ $key }}" required>
                                                    <span class="ml-4 text-sm font-medium text-gray-700 dark:text-gray-300 group-has-[:checked]:text-indigo-900 dark:group-has-[:checked]:text-white">{{ $value }}</span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Submit Answers
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>