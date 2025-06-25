<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Soal Quiz Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.questions.store') }}" method="POST">
                        @csrf
                        <!-- Pertanyaan -->
                        <div class="mb-4">
                            <label for="question_text" class="block text-gray-700 text-sm font-bold mb-2">Teks Pertanyaan:</label>
                            <textarea name="question_text" id="question_text" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                        <!-- Opsi A -->
                        <div class="mb-4">
                            <label for="option_a" class="block text-gray-700 text-sm font-bold mb-2">Pilihan A:</label>
                            <input type="text" name="option_a" id="option_a" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <!-- Opsi B -->
                        <div class="mb-4">
                            <label for="option_b" class="block text-gray-700 text-sm font-bold mb-2">Pilihan B:</label>
                            <input type="text" name="option_b" id="option_b" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <!-- Opsi C -->
                        <div class="mb-4">
                            <label for="option_c" class="block text-gray-700 text-sm font-bold mb-2">Pilihan C:</label>
                            <input type="text" name="option_c" id="option_c" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <!-- Opsi D -->
                        <div class="mb-4">
                            <label for="option_d" class="block text-gray-700 text-sm font-bold mb-2">Pilihan D:</label>
                            <input type="text" name="option_d" id="option_d" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <!-- Jawaban Benar -->
                        <div class="mb-4">
                            <label for="correct_answer" class="block text-gray-700 text-sm font-bold mb-2">Jawaban Benar:</label>
                            <select name="correct_answer" id="correct_answer" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Soal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>