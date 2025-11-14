<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::latest()->paginate(10);
        return view('rumah_sakit.index', compact('rumahSakits'));
    }

    public function create()
    {
        return view('rumah_sakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'alamat'  => 'required',
            'email'   => 'required|email|unique:rumah_sakits,email',
            'telepon' => 'required',
        ]);

        RumahSakit::create($request->all());

        return redirect()->route('rumah-sakit.index')->with('success', 'Rumah Sakit berhasil ditambah');
    }

    public function edit(RumahSakit $rumahSakit)
    {
        return view('rumah_sakit.edit', compact('rumahSakit'));
    }

    public function update(Request $request, RumahSakit $rumahSakit)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'alamat'  => 'required',
            'email'   => 'required|email|unique:rumah_sakits,email,'.$rumahSakit->id,
            'telepon' => 'required',
        ]);

        $rumahSakit->update($request->all());

        return redirect()->route('rumah-sakit.index')->with('success', 'Rumah Sakit berhasil diupdate');
    }

    public function destroy(RumahSakit $rumahSakit)
    {
        $rumahSakit->delete();

        return response()->json(['success' => true]);
    }
}
