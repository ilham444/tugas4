<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question; // Import model

class QuestionController extends Controller
{
    // Menampilkan semua soal
    public function index()
    {
        $questions = Question::all();
        // BENAR
return view('admin.questions.index', compact('questions'));
    }

    // Menampilkan form tambah soal
    public function create()
    {
        return view('admin.questions.create');
    }

    // Menyimpan soal baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Soal berhasil ditambahkan.');
    }
}
