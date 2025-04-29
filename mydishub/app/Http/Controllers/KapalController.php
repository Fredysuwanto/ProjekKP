<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Kategori;
use App\Models\Kapal;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kapal = Kapal::all();
        return view('kapal.index')
            ->with('kapal',$kapal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $kategori = Kategori::all();
        // return view('kapal.create')-> with('kategori',$kategori);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create',Kapal::class)){
            abort(403);
        }
        // dd($request);
        //validasi form
        $val = $request -> validate([
            'kategori_id' => "required",
            'nomor_menu' => "required|unique:menus",
            'url_menu' => "required|url",
            'nama_menu' => "required",
            'harga_menu' => "required",
        ]);
        //ekstensi file yang di upload
        // $ext = $request->url_menu->getClientOriginalExtension();
        // // $ext = $request->url_minuman->getClientOriginalExtension();
        // // //rename misal :npm.extensi 2226240145.png
        // $val['url_menu']= $request->nama_menu.".".$ext;
        // // $val['url_minuman']= $request->nama_minuman.".".$ext;
        // // //upload ke dalam folder public/foto
        // $request->url_menu->move('fotomenu/', $val['url_menu']);
        // $request->url_minuman->move('fotominuman/', $val['url_minuman']);
        //simpan ke tabel fakultas
        
        Kapal::create($val);
        //redirect ke fakultas
        return redirect()->route('kapal.index')->with('success',$val['nama_kapal'].'berhasil disimpan');
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
    public function edit($id)
    {
        $kapal = Kapal::find($id);
        $kategori = Kategori::all();
        return view('kapal.edit', compact('kapal'))->with('kategori',$kategori)->with('kapal',$kapal);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    if ($request->user()->cannot('create', Kapal::class)) {
        abort(403);
    }

    $val = $request->validate([
        'kategori_id' => "required",
        'nomor_menu' => "required|unique:menus,nomor_menu," . $id, // Tambahkan pengecualian id
        'url_menu' => "required|url",
        'nama_menu' => "required",
        'harga_menu' => "required",
    ]);

    // Cari menu berdasarkan id
    $kapal = Kapal::find($id);

    if ($kapal) {
        $kapal->update($val);
        return redirect()->route('kapal.index')->with('success', $val['nama_kapal'] . ' Berhasil di Edit');
    } else {
        return redirect()->route('kapal.index')->with('error', 'kapal tidak ditemukan');
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kapal $kapal)
    {
        // dd($mahasiswa);
        // $kapal = kapal::find($kapal);
        // File::delete('fotomakanan/'. $kapal['url_makanan']);
        // File::delete('fotominuman/'. $kapal['url_minuman']);
        $kapal->delete(); //hapus data mahasiswa
        return redirect() ->route('kapal.index')-> with('success','data berhasil dihapus');    }
}
