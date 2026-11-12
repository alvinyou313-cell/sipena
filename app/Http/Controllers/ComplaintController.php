<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Complaint::with('user');

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') &&
            in_array($request->status, ['Pending', 'Approved', 'Rejected'])) {
            $query->where('status', $request->status);
        }

        $complaints = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        abort_unless(auth()->user()->role === 'siswa', 403);

        return view('complaints.create');
    }

    public function store(Request $request)
    {
        abort_unless($request->user()->role === 'siswa', 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'title.required' => 'Judul pengaduan wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'location.required' => 'Lokasi kerusakan wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'photo.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('complaints', 'public');
        }

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'Pending';

        Complaint::create($validated);

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function show(Complaint $complaint)
    {
        $user = auth()->user();

        abort_unless(
            $user->role === 'admin' ||
            $complaint->user_id === $user->id,
            403
        );

        $complaint->load('user');

        return view('complaints.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        abort_unless($request->user()->role === 'admin', 403);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
            'admin_note' => 'nullable|string|max:2000',
        ]);

        $complaint->update($validated);

        return redirect()
            ->route('complaints.show', $complaint)
            ->with('success', 'Verifikasi pengaduan berhasil diperbarui!');
    }

    public function destroy(Request $request, Complaint $complaint)
    {
        $user = $request->user();

        abort_unless(
            $user->role === 'admin' ||
            ($complaint->user_id === $user->id &&
                $complaint->status === 'Pending'),
            403
        );

        if ($complaint->photo) {
            Storage::disk('public')->delete($complaint->photo);
        }

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
