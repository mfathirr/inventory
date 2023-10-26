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
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        $ruangan = Ruangan::all();
        return view('barang.edit', compact('barang', 'kategori', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $barang = Barang::findOrFail($id);
        if($request->hasFile('gambar')) {
            $destination_path = 'public/images/barang';
            $image = $request->file('gambar');
            $name = $image->getClientOriginalExtension();
            $path = $image->storeAs($destination_path, $name);
            $input['gambar'] = $name;
        }

        $barang->update($data);
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return back();
    }
}
