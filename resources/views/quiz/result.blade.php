<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Quiz Result
        </h2>
    </x-slot>

    {{-- Add Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .progress-ring__circle {
            transition: stroke-dashoffset 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 md:p-10 text-gray-900 dark:text-gray-100 text-center">
                    
                    @if(session('quiz_result'))
                        @php
                            $result = session('quiz_result');
                            $score = $result['score'];
                            $total = $result['total'];
                            $percentage = ($total > 0) ? ($score / $total) * 100 : 0;
                            
                            // For the circular progress bar
                            $radius = 60;
                            $circumference = 2 * M_PI * $radius;
                            $offset = $circumference - ($percentage / 100) * $circumference;
                        @endphp
                        
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Quiz Completed!</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8">Here's how you performed.</p>

                        {{-- Circular Progress Bar for Score --}}
                        <div class="relative inline-flex items-center justify-center mb-6">
                            <svg class="h-40 w-40">
                                <circle class="text-gray-200 dark:text-gray-700" stroke-width="12" stroke="currentColor" fill="transparent" r="{{$radius}}" cx="80" cy="80" />
                                <circle class="progress-ring__circle text-indigo-600 dark:text-indigo-500" stroke-width="12" stroke-linecap="round" stroke="currentColor" fill="transparent" r="{{$radius}}" cx="80" cy="80" style="stroke-dasharray: {{$circumference}}; stroke-dashoffset: {{$offset}};" />
                            </svg>
                            <span class="absolute text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ round($percentage) }}%</span>
                        </div>

                        {{-- Detailed Score and Feedback --}}
                        <p class="text-xl font-semibold">
                            You answered <strong>{{ $score }}</strong> out of <strong>{{ $total }}</strong> questions correctly.
                        </p>
                        
                        <div class="mt-4 text-lg font-medium">
                            @if ($percentage >= 80)
                                <p class="text-green-600 dark:text-green-400"><i class="fa-solid fa-trophy mr-2"></i>Excellent Work!</p>
                            @elseif ($percentage >= 50)
                                <p class="text-blue-600 dark:text-blue-400"><i class="fa-solid fa-thumbs-up mr-2"></i>Good Effort!</p>
                            @else
                                <p class="text-orange-500"><i class="fa-solid fa-book-open-reader mr-2"></i>Keep Practicing!</p>
                            @endif
                        </div>

                        <a href="{{ route('dashboard') }}" class="mt-10 inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-colors">
                            Return to Dashboard
                        </a>
                    @else
                        <div class="py-10">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-200">No Result to Display</h3>
                            <p class="mt-1 text-sm text-gray-500">We couldn't find your quiz result.</p>
                            <div class="mt-6">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Return to Dashboard
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>