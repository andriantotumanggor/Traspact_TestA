<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\TempatTugas;
use App\Models\UnitKerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::with(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas']);

        if ($request->has('search')) {
            $keyword = $request->get('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('nip', 'like', "%$keyword%")
                  ->orWhere('nama', 'like', "%$keyword%");
            });
        }

        if ($request->has('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->get('unit_kerja_id'));
        }

        return $query->paginate(10);
    }

    public function show($id)
    {
        return Pegawai::with(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:pegawai,nip',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jk' => 'required|in:L,P',
            'agama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'golongan_id' => 'required|exists:golongan,id',
            'eselon_id' => 'nullable|exists:eselon,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'tempat_tugas_id' => 'required|exists:tempat_tugas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_pegawai', 'public');
            $data['foto'] = $path;
        }

        $pegawai = Pegawai::create($data);

        return response()->json($pegawai->load(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas']), 201);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:pegawai,nip,' . $id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jk' => 'required|in:L,P',
            'agama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'golongan_id' => 'required|exists:golongan,id',
            'eselon_id' => 'nullable|exists:eselon,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'tempat_tugas_id' => 'required|exists:tempat_tugas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $path = $request->file('foto')->store('foto_pegawai', 'public');
            $data['foto'] = $path;
        }

        $pegawai->update($data);

        return response()->json($pegawai->load(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas']));
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return response()->json(['message' => 'Pegawai deleted successfully']);
    }

    public function search($keyword)
    {
        return Pegawai::where('nip', 'like', "%$keyword%")
            ->orWhere('nama', 'like', "%$keyword%")
            ->with(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas'])
            ->paginate(10);
    }

    public function filterByUnit($unitId)
    {
        return Pegawai::where('unit_kerja_id', $unitId)
            ->with(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas'])
            ->paginate(10);
    }

    public function generatePdf(Request $request)
    {
        $query = Pegawai::with(['golongan', 'eselon', 'jabatan', 'unitKerja', 'tempatTugas']);

        if ($request->has('search')) {
            $keyword = $request->get('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('nip', 'like', "%$keyword%")
                  ->orWhere('nama', 'like', "%$keyword%");
            });
        }

        if ($request->has('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->get('unit_kerja_id'));
        }

        $pegawai = $query->get();

        $pdf = Pdf::loadView('pegawai.pdf', compact('pegawai'));

        return $pdf->download('pegawai-list.pdf');
    }

    public function masterData()
    {
        return response()->json([
            'golongan' => Golongan::all(),
            'eselon' => Eselon::all(),
            'jabatan' => Jabatan::all(),
            'unit_kerja' => UnitKerja::with('children')->whereNull('parent_id')->get(),
            'tempat_tugas' => TempatTugas::all(),
        ]);
    }
}

