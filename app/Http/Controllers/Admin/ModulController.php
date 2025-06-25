<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moduls = Modul::latest()->paginate(10);
        return view('admin.modul.index', compact('moduls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.modul.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'description' => 'required|string',
            'estimated' => 'required|integer',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        // Generate slug with prefix 'modul', title, and current timestamp
        $validated['slug'] = 'modul-' . Str::slug($request->title) . '-' . time();

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('modul-thumbnails', 'public');
        }

        Modul::create($validated);
        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        return view('admin.modul.show', compact('modul'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {
        $kategoris = Kategori::all(); // <-- Ambil semua kategori
        return view('admin.modul.edit', compact('modul', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'description' => 'required|string',
            'estimated' => 'required|integer',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        // Regenerate slug with prefix 'modul', title, and current timestamp
        $validated['slug'] = 'modul-' . Str::slug($request->title) . '-' . time();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($modul->thumbnail && Storage::disk('public')->exists($modul->thumbnail)) {
                Storage::disk('public')->delete($modul->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('modul-thumbnails', 'public');
        }

        $modul->update($validated);
        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        // Delete thumbnail if exists
        if ($modul->thumbnail && Storage::disk('public')->exists($modul->thumbnail)) {
            Storage::disk('public')->delete($modul->thumbnail);
        }
        $modul->delete();
        return redirect()->route('admin.modul.index')->with('success', 'Modul berhasil dihapus.');
    }
}
