<?php
// file: app/Http/Controllers/Admin/MateriController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->paginate(10);
        return view('admin.materi.index', compact('materi'));
    }

    // Dalam method create()
public function create()
{
    $kategoris = Kategori::all(); // <-- Ambil semua kategori
    return view('admin.materi.create', compact('kategoris')); // <-- Kirim ke view
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,png,mp4|max:10240',
            'kategori_id' => 'required|exists:kategoris,id', // max 10MB
        ]);

        $filePath = $request->file('file')->store('materi_files', 'public');

        Materi::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'kategori_id' => $request->kategori_id,
        ]); 

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
{
    $kategoris = Kategori::all(); // <-- Ambil semua kategori
    return view('admin.materi.edit', compact('materi', 'kategoris')); // <-- Kirim ke view
}

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png,mp4|max:10240',
        ]);

        $filePath = $materi->file_path;
        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($materi->file_path);
            // Upload file baru
            $filePath = $request->file('file')->store('materi_files', 'public');
        }

        $materi->update([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        // Hapus file dari storage
        Storage::disk('public')->delete($materi->file_path);
        
        // Hapus record dari database
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}