<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Tampilkan detail materi untuk user, termasuk komentar-komentar dan user yang mengomentari.
     */
    public function show(Materi $materi)
    {
        // Memuat relasi komentar beserta user-nya
        $materi->load(['komentars.user']);

        return view('user.materi.show', compact('materi'));
    }
}
