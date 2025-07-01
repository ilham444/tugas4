{{-- Main Non-Admin Layout --}}
<x-app-layout>
    {{-- Soft gray background for the entire page --}}
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen font-sans">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 md:p-10 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                
                {{-- Practice Title --}}
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-indigo-700 dark:text-indigo-400 mb-2">{{ $latihan->judul }}</h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg mb-8">{{ $latihan->deskripsi }}</p>
                </div>
                
                <hr class="dark:border-gray-700 mb-10">

                {{-- Answer Form --}}
                <form action="{{ route('latihan.submit', $latihan->id) }}" method="POST">
                    @csrf

                    {{-- Question Loop --}}
                    <div class="space-y-12">
                        @foreach($latihan->soals as $index => $soal)
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-200 dark:border-gray-700/80">
                                {{-- Question Text --}}
                                <div class="flex items-start mb-5">
                                    <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full bg-indigo-600 text-white font-bold text-lg mr-4">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-relaxed">{{ $soal->pertanyaan }}</p>
                                </div>

                                {{-- Media if available --}}
                                @if($soal->tipe_media != 'none' && $soal->url_media)
                                    <div class="my-5 rounded-lg overflow-hidden">
                                        @if($soal->tipe_media == 'video')
                                            <video controls controlslist="nodownload" class="w-full rounded-lg shadow-md">
                                                <source src="{{ asset('storage/' . $soal->url_media) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif($soal->tipe_media == 'audio')
                                            <audio controls class="w-full mt-2">
                                                <source src="{{ asset('storage/' . $soal->url_media) }}" type="audio/mpeg">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        @endif
                                    </div>
                                @endif

                                {{-- Answer Options (Upgraded for better UX) --}}
                                <div class="space-y-4">
                                    @foreach($soal->pilihanJawabans as $pilihan)
                                        <label class="has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500 has-[:checked]:ring-2 has-[:checked]:ring-indigo-500 dark:has-[:checked]:bg-indigo-900/50 dark:has-[:checked]:border-indigo-500 group flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/60 transition-all duration-200">
                                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $pilihan->id }}" class="h-5 w-5 text-indigo-600 border-gray-300 dark:border-gray-500 focus:ring-indigo-500 focus:ring-offset-gray-800" required>
                                            <span class="ml-4 text-gray-800 dark:text-gray-300 group-has-[:checked]:font-semibold group-has-[:checked]:text-indigo-900 dark:group-has-[:checked]:text-white">{{ $pilihan->jawaban }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-12">
                        <button type="submit" class="w-full flex items-center justify-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-4 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-indigo-500/50 transform hover:-translate-y-1">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Finish & Submit Answers
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>