<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
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
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'topic' => 'nullable|string',
            'participants' => 'nullable|string',
            'note' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx',
        ]);

        $data = $request->all();
        $data['creator_id'] = Auth::id();
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }
        Permission::create($data);



        return redirect()->route('permissions.index')->with('success', 'Izin berhasil diajukan.');
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

    public function exportPdf(Permission $permission)
    {
        // Pastikan relasi 'user' dan 'approver' dimuat
        $permission->load(['user', 'approver']);

        // Generate PDF
        $pdf = Pdf::loadView('pegawai.exportpermissions-pdf', compact('permission'));

        return $pdf->download('undangan_rapat_' . $permission->id . '.pdf');
    }

<<<<<<< HEAD
    public function exportPdfAdmin(Permission $permission)
    {
        // Pastikan relasi 'user' dan 'approver' dimuat
        $permission->load(['user', 'approver']);

        // Generate PDF
        $pdf = Pdf::loadView('admin.exportpermissions-pdf', compact('permission'));

        return $pdf->download('undangan_rapat_' . $permission->id . '.pdf');
    }

=======
>>>>>>> 438602ee89af6e1ce30a85617231092f54394442




    // Menampilkan daftar izin untuk atasan
    public function indexAtasan()
    {
        $permissions = Permission::with('user', 'approver')
            ->latest()
            ->paginate(10);

        return view('atasan.permissionsatasan', compact('permissions'));
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
