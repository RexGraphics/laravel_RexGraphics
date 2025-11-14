<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $rumahSakits = RumahSakit::orderBy('nama')->get();

        if ($request->ajax()) {
            $rsId = $request->get('rumah_sakit_id');
            $pasien = Pasien::with('rumahSakit')
                ->when($rsId, fn($q) => $q->where('rumah_sakit_id', $rsId))
                ->latest()->get();

            return view('pasien.partials.table', compact('pasien'))->render();
        }

        $pasien = Pasien::with('rumahSakit')->latest()->paginate(10);
        return view('pasien.index', compact('pasien', 'rumahSakits'));
    }

    public function filter(Request $request)
    {
        $rsId = $request->get('rumah_sakit_id');
        $pasien = Pasien::with('rumahSakit')
            ->when($rsId, fn($q) => $q->where('rumah_sakit_id', $rsId))
            ->latest()->get();

        return view('pasien.partials.table', compact('pasien'))->render();
    }

    public function create()
    {
        $rumahSakits = RumahSakit::orderBy('nama')->get();
        return view('pasien.create', compact('rumahSakits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'alamat'          => 'required',
            'telepon'      => 'required',
            'rumah_sakit_id'  => 'required|exists:rumah_sakits,id',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambah');
    }

    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::orderBy('nama')->get();
        return view('pasien.edit', compact('pasien', 'rumahSakits'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'alamat'          => 'required',
            'telepon'      => 'required',
            'rumah_sakit_id'  => 'required|exists:rumah_sakits,id',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diupdate');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return response()->json(['success' => true]);
    }
}
