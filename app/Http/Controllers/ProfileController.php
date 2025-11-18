<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Profile::all();
        return view('profiles.index', compact('data'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kandidat' => 'required',
            'position_kandidat' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $foto = $request->file('image');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/profile_images', $filename);
        }


        Profile::create([
            'nama_kandidat' => $request->nama_kandidat,
            'position_kandidat' => $request->position_kandidat,
            'image' => $filename
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profile berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $row = Profile::findOrFail($id);
        return view('profiles.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = Profile::findOrFail($id);

        $request->validate([
            'nama_kandidat' => 'required',
            'position_kandidat' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $filename = $row->image;

        if ($request->hasFile('image')) {
            $foto = $request->file('image');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/profile_images', $filename);
        }


        $row->update([
            'nama_kandidat' => $request->nama_kandidat,
            'position_kandidat' => $request->position_kandidat,
            'image' => $filename
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profile berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Profile::findOrFail($id)->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile berhasil dihapus!');
    }
}
