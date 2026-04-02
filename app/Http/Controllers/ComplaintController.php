<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255', // Tambahkan validasi lokasi
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('complaints', 'public');
            $validated['photo'] = 'storage/' . $path;
        }

        Complaint::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'title' => $validated['title'],
            'location' => $validated['location'], // Simpan lokasi ke database
            'description' => $validated['description'],
            'photo' => $validated['photo'] ?? null,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Aduan berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,resolved'
        ]);

        $complaint->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status pengaduan diperbarui!');
    }

    public function report()
    {
        $complaints = Complaint::with(['user', 'responses.user'])->latest()->get();
        return view('admin.report', compact('complaints'));
    }

    public function destroy($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);

            // Hapus tanggapan terkait
            $complaint->responses()->delete();

            if ($complaint->photo) {
                // Gunakan Helper Storage secara langsung agar lebih rapi
                $photoPath = str_replace('storage/', '', $complaint->photo);
                Storage::disk('public')->delete($photoPath);
            }

            $complaint->delete();
            return redirect()->back()->with('success', 'Pengaduan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pengaduan: ' . $e->getMessage());
        }
    }
}