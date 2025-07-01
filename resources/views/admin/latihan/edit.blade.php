{{-- Use your admin layout --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit Practice') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Editing: <span class="font-medium">{{ $latihan->judul }}</span>
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Display validation errors if any --}}
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                    <p class="font-bold">Validation Error</p>
                    <p>Please review the fields below.</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Action points to the update route --}}
            <form action="{{ route('admin.latihan.update', $latihan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Add PUT method for updating --}}
                @method('PUT')

                {{-- Practice Information Section --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-6 border border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold mb-4 border-b pb-3 text-gray-800 dark:text-gray-200">Practice Information</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Practice Title</label>
                            {{-- Value is filled from $latihan, with old() as a fallback --}}
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $latihan->judul) }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label for="modul_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Related Module</label>
                            <select name="modul_id" id="modul_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="" disabled>-- Select a Module --</option>
                                @foreach ($moduls as $modul)
                                    <option value="{{ $modul->id }}" {{ old('modul_id', $latihan->modul_id) == $modul->id ? 'selected' : '' }}>
                                        {{ $modul->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-lg">{{ old('deskripsi', $latihan->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Dynamic Questions Section with Alpine.js --}}
                @php
                    // Convert the Eloquent collection of questions to a plain PHP array for Alpine.js
                    // This is important to ensure the data structure is compatible.
                    $soalArray = [];
                    if (old('soal')) {
                        // If there is data from old(), use that
                        $soalArray = old('soal');
                    } else {
                        // Otherwise, format the data from the database
                        foreach ($latihan->soals as $soal) {
                            $pilihanArray = [];
                            $jawabanBenarIndex = null;
                            foreach ($soal->pilihanJawabans as $index => $pilihan) {
                                $pilihanArray[] = $pilihan->jawaban;
                                if ($pilihan->is_benar) {
                                    $jawabanBenarIndex = $index;
                                }
                            }
                            $soalArray[] = [
                                'pertanyaan' => $soal->pertanyaan,
                                'pilihan' => $pilihanArray,
                                'jawaban_benar' => (string) $jawabanBenarIndex, // ensure it's a string
                                'mediaName' => $soal->url_media ? basename($soal->url_media) : '',
                                'previousMediaName' => $soal->url_media ? basename($soal->url_media) : '',
                            ];
                        }
                    }
                @endphp
                
                <div x-data="{
                    soals: @json($soalArray),
                    addSoal() {
                        this.soals.push({ pertanyaan: '', pilihan: ['', '', '', ''], jawaban_benar: '', mediaName: '', previousMediaName: '' });
                    }
                }">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Practice Questions</h2>
                        <button type="button" @click="addSoal()" class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                            Add Question
                        </button>
                    </div>

                    <template x-for="(soal, index) in soals" :key="index">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-6 relative border-t-4 border-indigo-500">
                             {{-- Delete Question Button --}}
                            <div class="absolute top-4 right-4">
                                 <button type="button" @click="soals.splice(index, 1)" x-show="soals.length > 1" class="text-gray-400 hover:text-red-500 transition duration-300 p-2 rounded-full hover:bg-red-100 dark:hover:bg-red-900/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                 </button>
                            </div>

                            <h3 class="font-bold text-lg mb-4 text-gray-700 dark:text-gray-300" x-text="'Question #' + (index + 1)"></h3>

                            {{-- Question --}}
                            <div class="mb-4">
                                <label :for="'pertanyaan_' + index" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question</label>
                                <textarea :id="'pertanyaan_' + index" :name="'soal[' + index + '][pertanyaan]'" x-model="soal.pertanyaan" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-lg" required></textarea>
                            </div>

                            {{-- Media Upload --}}
                            <div class="mb-4">
                                <label :for="'media_' + index" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Change Media (Optional)</label>
                                <input type="hidden" :name="'soal[' + index + '][mediaName]'" :value="soal.mediaName">
                                <div class="flex items-center">
                                    <input type="file" :id="'media_' + index" :name="'soal[' + index + '][media]'" @change="soal.mediaName = $event.target.files.length > 0 ? $event.target.files[0].name : soal.previousMediaName" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 cursor-pointer">
                                </div>
                                <div x-show="soal.previousMediaName" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Current file: <strong x-text="soal.previousMediaName"></strong>. Leave empty if you don't want to change it.
                                </div>
                            </div>

                            {{-- Answer Options --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Answer Options</label>
                                <div class="space-y-3">
                                    <template x-for="(pilihan, p_index) in soal.pilihan" :key="p_index">
                                        <div class="flex items-center">
                                            <input type="radio" :id="'jawaban_benar_' + index + '_' + p_index" :name="'soal[' + index + '][jawaban_benar]'" :value="p_index" x-model="soal.jawaban_benar" class="h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-500 focus:ring-indigo-500" required>
                                            <input type="text" :id="'pilihan_' + index + '_' + p_index" :name="'soal[' + index + '][pilihan][' + p_index + ']'" x-model="soal.pilihan[p_index]" class="ml-3 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-lg" :placeholder="'Option ' + String.fromCharCode(65 + p_index)" required>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Main Submit Button --}}
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 text-lg transition-colors">
                            Update Practice
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>