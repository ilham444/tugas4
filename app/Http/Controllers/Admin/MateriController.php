<?php
// file: app/Http/Controllers/Admin/MateriController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Materi;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(Modul $modul)
    {

        $materi = $modul->materis()->latest()->paginate(10);
        return view('admin.materi.index', compact('materi', 'modul'));
    }

    // Dalam method create()
    public function create(Modul $modul)
    {
        $moduls = Modul::all(); // <-- Ambil semua modul
        return view('admin.materi.create', compact('moduls', 'modul')); // <-- Kirim ke view
    }


    public function store(Request $request, Modul $modul)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,png,mp4|max:10240',
            'urutan' => 'required|integer'
        ]);

        $filePath = $request->file('file')->store('materi_files', 'public');

        Materi::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'kategori_id' => $request->kategori_id,
            'slug' => \Str::slug($request->title . '-' . now()->format('YmdHis')),
            'modul_id' => $modul->id,
            'urutan' => $request->urutan
        ]);

        return redirect()->route('admin.modul.materi.index', $modul)->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Modul $modul, Materi $materi)
    {
        $kategoris = Kategori::all(); // <-- Ambil semua kategori
        return view('admin.materi.edit', compact('materi', 'kategoris', 'modul')); // <-- Kirim ke view
    }

    public function update(Request $request, Modul $modul, Materi $materi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png,mp4|max:10240',
            'urutan' => 'required|integer'
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
            'urutan' => $request->urutan
        ]);

        return redirect()->route('admin.modul.materi.index', $modul)->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Modul $modul, Materi $materi)
    {
        // Hapus file dari storage
        Storage::disk('public')->delete($materi->file_path);

        // Hapus record dari database
        $materi->delete();

        return redirect()->route('admin.modul.materi.index', $modul)->with('success', 'Materi berhasil dihapus.');
    }
}
