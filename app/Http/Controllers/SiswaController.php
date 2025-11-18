<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Exception;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $lembaga = Lembaga::all();

        $query = Siswa::with('lembaga');

        // Search NIS & Nama
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nis', 'like', '%' . $request->search . '%')
                    ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter lembaga
        if ($request->lembaga_id) {
            $query->where('lembaga_id', $request->lembaga_id);
        }

        $siswa = $query->orderBy('nis', 'asc')->get();

        return view('siswa.index', compact('siswa', 'lembaga'));
    }

    public function create()
    {
        $lembaga = Lembaga::all();
        return view('siswa.create', compact('lembaga'));
    }
    public function export()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'lembaga_id' => 'required',
            'nis' => 'required|numeric|unique:siswas,nis',
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('foto_siswa', $filename);

                $validated['foto'] = $filename;
            }


            Siswa::create($validated);

            Alert::success('Sukses', 'Data siswa berhasil ditambahkan.');
            return redirect('/siswa');
        } catch (\Exception $ex) {

            Log::error("Error store siswa: " . $ex->getMessage());

            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data siswa!');

            return redirect('/siswa/create')->withInput();
        }
    }


    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $lembaga = Lembaga::all();

        return view('siswa.edit', compact('siswa', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'lembaga_id' => 'required',
            'nis' => 'required|numeric|unique:siswa,nis,' . $id,
            'nama' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,png|max:100'
        ]);

        try {
            $siswa = Siswa::findOrFail($id);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('foto_siswa', $filename);
                $validated['foto'] = $filename;
            }

            $siswa->update($validated);

            Alert::success('Sukses', 'Data siswa diperbarui!');
            return redirect('/siswa');
        } catch (Exception $e) {
            Alert::error('Error', 'Gagal update data siswa');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            Alert::success('Success', 'Siswa deleted!');
            return redirect('/siswa');
        } catch (Exception $e) {
            Alert::warning('Error', 'Cannot delete siswa!');
            return redirect('/siswa');
        }
    }
}
