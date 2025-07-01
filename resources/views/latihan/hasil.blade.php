<x-app-layout>
    {{-- Soft gray background for the entire page --}}
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen font-sans">
        <div class="container mx-auto px-4 py-12">

            {{-- MAIN RESULT CARD --}}
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-8 md:p-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        
                        {{-- Left Side: Donut Chart & Score --}}
                        <div class="relative flex justify-center items-center">
                            {{-- SVG for Donut Chart --}}
                            <svg class="transform -rotate-90 w-48 h-48 sm:w-64 sm:h-64" viewBox="0 0 120 120">
                                {{-- Background circle --}}
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#e5e7eb" class="dark:stroke-gray-700" stroke-width="12" />
                                {{-- Progress (score) circle --}}
                                <circle 
                                    cx="60" 
                                    cy="60" 
                                    r="54" 
                                    fill="none" 
                                    stroke="url(#grade-gradient)" 
                                    stroke-width="12"
                                    stroke-linecap="round"
                                    stroke-dasharray="{{ 2 * 3.14159 * 54 }}" {{-- Circle circumference --}}
                                    stroke-dashoffset="{{ (2 * 3.14159 * 54) * (1 - ($nilaiAkhir / 100)) }}" {{-- The empty part --}}
                                    class="transition-all duration-1000 ease-out"
                                />
                                {{-- Gradient definition for the stroke --}}
                                <defs>
                                    <linearGradient id="grade-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#3B82F6;" /> {{-- Indigo-500 --}}
                                        <stop offset="100%" style="stop-color:#1D4ED8;" /> {{-- Indigo-700 --}}
                                    </linearGradient>
                                </defs>
                            </svg>
                            {{-- Score text in the middle --}}
                            <div class="absolute flex flex-col items-center justify-center">
                                <span class="text-5xl sm:text-6xl font-bold text-blue-800 dark:text-blue-400">{{ round($nilaiAkhir) }}</span>
                                <span class="text-gray-500 dark:text-gray-400 font-medium">Points</span>
                            </div>
                        </div>

                        {{-- Right Side: Text & Button --}}
                        <div class="text-center md:text-left">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">
                                @if($nilaiAkhir >= 80)
                                    Excellent Work!
                                @elseif($nilaiAkhir >= 60)
                                    Great Job!
                                @else
                                    Keep Practicing!
                                @endif
                            </h1>
                            <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">You have completed the practice <strong class="text-gray-700 dark:text-gray-200">{{ $latihan->judul }}</strong>.</p>
                            
                            <div class="bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20 rounded-lg p-4 text-center mb-6">
                                <p class="text-lg font-semibold text-blue-800 dark:text-blue-300">
                                    You answered {{ $skor }} out of {{ $totalSoal }} questions correctly.
                                </p>
                            </div>
                            
                            <a href="{{ url('/') }}" class="inline-flex items-center bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Return to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ANSWER DETAILS CARD --}}
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 md:p-12 rounded-2xl shadow-xl mt-10 border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Answer Breakdown</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Review your answers for each question.</p>
                </div>

                <div class="space-y-8">
                    @foreach($hasilJawaban as $hasil)
                        <div class="p-5 border rounded-xl {{ $hasil['is_benar'] ? 'border-green-200 dark:border-green-500/30 bg-green-50 dark:bg-green-500/10' : 'border-red-200 dark:border-red-500/30 bg-red-50 dark:bg-red-500/10' }}">
                            {{-- Question --}}
                            <div class="flex items-start">
                                <span class="font-bold text-gray-700 dark:text-gray-300 mr-3">{{ $loop->iteration }}.</span>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $hasil['soal']->pertanyaan }}</p>
                            </div>
                            
                            {{-- Answer Options --}}
                            <ul class="mt-4 space-y-3 pl-8">
                                @foreach($hasil['soal']->pilihanJawabans as $pilihan)
                                    <li class="flex items-center text-gray-700 dark:text-gray-300 p-3 rounded-lg
                                        {{-- Style for the correct answer --}}
                                        @if($pilihan->is_benar) bg-green-100 dark:bg-green-900/40 border border-green-300 dark:border-green-500/50 @endif
                                        {{-- Style for the user's incorrect answer --}}
                                        @if(!$hasil['is_benar'] && $pilihan->id == $hasil['jawaban_pengguna_id']) bg-red-100 dark:bg-red-900/40 border border-red-300 dark:border-red-500/50 @endif
                                    ">
                                        
                                        @if($pilihan->id == $hasil['jawaban_pengguna_id'])
                                            @if($hasil['is_benar'])
                                                {{-- User's Answer (Correct) --}}
                                                <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span class="flex-grow">{{ $pilihan->jawaban }}</span>
                                                <span class="text-xs font-bold text-green-700 dark:text-green-400 ml-2">(Your Answer)</span>
                                            @else
                                                {{-- User's Answer (Incorrect) --}}
                                                <svg class="h-6 w-6 text-red-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span class="flex-grow line-through">{{ $pilihan->jawaban }}</span>
                                                <span class="text-xs font-bold text-red-700 dark:text-red-400 ml-2">(Your Answer)</span>
                                            @endif
                                        @elseif($pilihan->is_benar)
                                            {{-- Correct Answer (not chosen by user) --}}
                                            <svg class="h-6 w-6 text-green-500 dark:text-green-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <span class="flex-grow font-bold">{{ $pilihan->jawaban }}</span>
                                            <span class="text-xs font-semibold text-green-700 dark:text-green-400 ml-2">(Correct Answer)</span>
                                        @else
                                            {{-- Other option (not chosen & not correct) --}}
                                            <svg class="h-6 w-6 text-gray-300 dark:text-gray-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <span class="flex-grow text-gray-600 dark:text-gray-400">{{ $pilihan->jawaban }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>