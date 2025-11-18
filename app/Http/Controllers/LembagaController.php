<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class LembagaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lembaga::query();

        // Search
        if ($request->search) {
            $query->where('nama_lembaga', 'like', '%' . $request->search . '%');
        }

        $lembaga = $query->orderBy('nama_lembaga', 'asc')->get();

        return view('lembaga.index', compact('lembaga'));
    }


    public function create()
    {
        return view('lembaga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|unique:lembagas,nama_lembaga'
        ]);

        Lembaga::create($validated);

        Alert::success('Sukses', 'Data lembaga berhasil ditambahkan!');
        return redirect('/lembaga');
    }

    public function edit($id)
    {
        $lembaga = Lembaga::findOrFail($id);
        return view('lembaga.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|unique:lembagas,nama_lembaga,' . $id
        ]);

        $lembaga = Lembaga::findOrFail($id);
        $lembaga->update($validated);

        Alert::success('Success', 'Data lembaga berhasil diperbarui!');
        return redirect('/lembaga');
    }

    public function destroy($id)
    {
        $lembaga = Lembaga::findOrFail($id);
        $lembaga->delete();

        Alert::success('Success', 'Lembaga berhasil dihapus!');
        return redirect('/lembaga');
    }
}
