<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Soal Quiz
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Form menunjuk ke route 'admin.questions.update' --}}
                    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- PENTING: Method harus PUT atau PATCH untuk update resource --}}

                        <!-- Pertanyaan -->
                        <div class="mb-4">
                            <label for="question_text" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                            <textarea name="question_text" id="question_text" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('question_text', $question->question_text) }}</textarea>
                        </div>

                        {{-- Jika Anda punya field untuk pilihan jawaban, tambahkan di sini --}}
                        {{-- Contoh:
                        <div class="mb-4">
                            <label for="option_a" class="block text-sm font-medium text-gray-700">Pilihan A</label>
                            <input type="text" name="option_a" id="option_a" value="{{ old('option_a', $question->option_a) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        --}}

                        <!-- Jawaban Benar -->
                        <div class="mb-4">
                            <label for="correct_answer" class="block text-sm font-medium text-gray-700">Jawaban Benar</label>
                            <select name="correct_answer" id="correct_answer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">Pilih Jawaban</option>
                                <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
                                {{-- Tambahkan pilihan E jika ada --}}
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.questions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>