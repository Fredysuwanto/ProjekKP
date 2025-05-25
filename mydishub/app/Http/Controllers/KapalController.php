<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;

class KapalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $kapal = Kapal::all();
        return view('kapal.index')->with('kapal', $kapal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
              return view('kapal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $val = $request->validate([
            'nama' => "required|max:25",
            'noplat' => "required|max:16",
            'jenis' => "required|max:16",
            'ukuran' => "required",
            'daya' => "required",
            'muatan' => "required",
            'jenisperizinan' => "required",

        ]);

        Kapal::create($val);
        return redirect()->route('kapal.index')->with('success', $val['nama'] . ' berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kapal $kapal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kapal $kapal)
    {
         return view('kapal.edit')->with('kapal', $kapal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kapal $kapal)
    {
        $request->validate([
            'nama' => "required|max:25",
            'noplat' => "required|max:16",
            'jenis' => "required|max:16",
            'ukuran' => "required",
            'daya' => "required",
            'muatan' => "required",
            'jenisperizinan' => "required",

        ]);
         $kapal->update($request->all());

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kapal $kapal)
    {
        $kapal->delete(); //hapus data kapal
        return redirect() ->route('kapal.index')-> with('success','data kapal berhasil dihapus');
    }
}
