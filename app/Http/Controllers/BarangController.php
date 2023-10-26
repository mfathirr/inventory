<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        $kategori = Kategori::all();
        return view('barang.index', compact('barang', 'ruangan', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->hasFile('gambar')) {
            $destination_path = 'public/images/barang';
            $image = $request->file('gambar');
            $name = $image->getClientOriginalExtension();
            $path = $image->storeAs($destination_path, $name);
            $input['gambar'] = $name;
        }

        $input['nomor_barang'] = 'Barang'.' '.random_int(100, 9999);
        Barang::create($input);
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
