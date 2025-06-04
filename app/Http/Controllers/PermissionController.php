<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
    //PEGAWAI
    public function index()
    {
        $permissions = Permission::with('user', 'approver')
            ->when(Auth::user()->role === 'pegawai', function ($query) {
                $query->where('creator_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('pegawai.permissions', compact('permissions'));
    }

    public function create()
    {
        return view('pegawai.createpermissions');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'topic' => 'required|string',
            'participants' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $status = $request->action === 'draft' ? 'draft' : 'pending';

        $permission = Permission::create([
            'creator_id' => auth()->id(),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'topic' => $validated['topic'],
            'participants' => $validated['participants'],
            'note' => $validated['note'] ?? null,
            'status' => $status,
        ]);

        $message = $status === 'draft' ? 'Undangan disimpan sebagai arsip.' : 'Undangan berhasil diajukan.';

        return redirect()->route('pegawai.permissions.index')->with('success', $message);
    }

    public function exportPdf(Permission $permission)
    {
        // Pastikan relasi 'user' dan 'approver' dimuat
        $permission->load(['user', 'approver']);

        // Convert logo menjadi base64 agar bisa dibaca DomPDF
        $path = public_path('images/logo_kantor.jpeg');

        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            $base64Logo = null; // atau bisa pakai gambar default
        }

        // Generate PDF
        $pdf = Pdf::loadView('pegawai.exportpermissions-pdf', compact('permission', 'base64Logo'));

        return $pdf->download('undangan_rapat_' . $permission->id . '.pdf');
    }

    public function download(Permission $permission)
    {
        if ($permission->status !== 'draft') {
            return redirect()->back()->with('error', 'Hanya undangan berstatus arsip yang bisa diunduh.');
        }

        $pdf = Pdf::loadView('pegawai.arsip', compact('permission'));

        return $pdf->download('undangan-rapat-' . $permission->id . '.pdf');
    }


    //ATASAN

    public function indexAtasan()
    {
        $permissions = Permission::with('user', 'approver')
            ->latest()
            ->paginate(10);

        return view('atasan.permissionsatasan', compact('permissions'));
    }

    public function showAtasan($id)
    {
        $user = User::findOrFail($id);

        return view('atasan.profilpegawai', compact('user'));
    }
    public function storeatasan(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'topic' => 'required|string',
            'participants' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $status = $request->action === 'draft' ? 'draft' : 'pending';

        $permission = Permission::create([
            'creator_id' => auth()->id(),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'topic' => $validated['topic'],
            'participants' => $validated['participants'],
            'note' => $validated['note'] ?? null,
            'status' => $status,
        ]);

        $message = $status === 'draft' ? 'Undangan disimpan sebagai arsip.' : 'Undangan berhasil diajukan.';

        return redirect()->route('atasan.permissions.index')->with('success', $message);
    }


    public function approve(Permission $permission)
    {
        $permission->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Izin disetujui.');
    }
    public function reject(Permission $permission)
    {
        $permission->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('error', 'Izin ditolak.');
    }

    //ADMIN
    public function exportPdfAdmin(Permission $permission)
    {
        // Pastikan relasi 'user' dan 'approver' dimuat
        $permission->load(['user', 'approver']);

        // Generate PDF
        $pdf = Pdf::loadView('admin.exportpermissions-pdf', compact('permission'));

        return $pdf->download('undangan_rapat_' . $permission->id . '.pdf');
    }

    public function indexAdmin(Request $request)
    {
        $query = Permission::with(['user', 'approver'])->latest();

        // Cek apakah ada filter status di request
        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $permissions = $query->paginate(10)->withQueryString();

        return view('admin.permissionadmin', compact('permissions'));
    }

    public function showAdmin($id)
    {
        $permission = Permission::with(['user', 'approver'])->findOrFail($id);

        return view('admin.show', compact('permission'));
    }

    public function destroyAdmin($id)
    {
        $permission = Permission::findOrFail($id);

        // Opsional: kamu bisa cek hak akses admin di sini jika perlu

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Undangan berhasil dihapus.');
    }
}
