<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query()->whereHas('materis');

        // Filter pencarian berdasarkan judul materi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('materis', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Ambil kategori beserta materinya (dengan filter kalau ada pencarian)
        $kategoris = $query->with(['materis' => function ($q) use ($request) {
            if ($request->has('search') && $request->search != '') {
                $q->where('title', 'like', "%{$request->search}%");
            }
        }])->latest()->get();

        return view('user.dashboard', compact('kategoris'));
    }
}
