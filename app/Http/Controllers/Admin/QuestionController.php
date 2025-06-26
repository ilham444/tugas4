<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Menampilkan semua soal.
     */
    public function index()
    {
        // Mengurutkan dari yang terbaru, dan menggunakan pagination untuk data yang banyak
        $questions = Question::latest()->paginate(10); 
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Menampilkan form untuk menambahkan soal baru.
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Menyimpan soal baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question_text'   => 'required|string|max:1000',
            'option_a'        => 'required|string|max:255',
            'option_b'        => 'required|string|max:255',
            'option_c'        => 'required|string|max:255',
            'option_d'        => 'required|string|max:255',
            'correct_answer'  => 'required|in:A,B,C,D',
        ]);

        Question::create($validatedData);

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit soal.
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Memperbarui soal di database.
     */
    public function update(Request $request, Question $question)
    {
        $validatedData = $request->validate([
            'question_text'   => 'required|string|max:1000',
            'option_a'        => 'required|string|max:255',
            'option_b'        => 'required|string|max:255',
            'option_c'        => 'required|string|max:255',
            'option_d'        => 'required|string|max:255',
            'correct_answer'  => 'required|in:A,B,C,D',
        ]);

        $question->update($validatedData);

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Menghapus soal dari database.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Soal berhasil dihapus.');
    }
}