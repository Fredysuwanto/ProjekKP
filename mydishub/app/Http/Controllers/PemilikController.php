<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemilik = Pemilik::all();
        return view('pemilik.index')->with('pemilik', $pemilik);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
         if (Pemilik::count() >= 1) {
        return redirect()->route('pemilik.index')->with('error', 'Data pemilik sudah ada.');
    }
        
        return view('pemilik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'nama' => "required",
            'nik' => "required|max:16",
            'alamat' => "required",
            'telepon' => "required",
            'email' => "required|email",
        ]);

        Pemilik::create($val);
        return redirect()->route('pemilik.index')->with('success', $val['nama'] . ' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        return view('pemilik.edit')->with('pemilik', $pemilik);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => "required|max:16",
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
        ]);

        $pemilik->update($request->all());

        return redirect()->route('pemilik.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        //
    }
}
