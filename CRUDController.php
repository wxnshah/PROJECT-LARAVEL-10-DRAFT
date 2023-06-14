<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paparSenaraiData()
    {
        // View Page Senarai Data
        $senaraiData = DB::table('data')->get();
        return view('senarai_data', compact('senaraiData'));
    }

    public function paparTambahData()
    {
        // View Page Senarai Data
        return view('tambah_data');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Storing Data To Database
        $request->validate([
            'name' => ['required', 'min:3', 'string'], 
            'nokp' => ['required', 'string'], 
            'phone' => ['required', 'string'], 
            'email' => ['required', 'email:filter'], 
        ]);

        // Simpan ke DB
        DB::table('data')->insert([
            'name' => $request->input('name'),
            'nokp' => $request->input('nokp'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'created_at' => now(),
        ]);

        // Response
        return redirect()->route('senarai_data')
        ->with('success-insert', 'Rekod berjaya disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function paparKemaskiniData($id)
    {
        // Edit Data
        $data = DB::table('data')->where('id_data', '=', $id)->first();
        return view('kemaskini_data', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kemaskiniData(Request $request, $id)
    {
        // Kemaskini Data
        $data = $request->validate([
            'name' => ['required', 'min:3', 'string'], 
            'nokp' => ['required', 'string'], 
            'phone' => ['required', 'string'], 
            'email' => ['required', 'email:filter'],
            'updated_at' => ['required'],
        ]);

        // Simpan ke DB
        DB::table('data')->where('id_data', $id)->update($data);

        // Response
        return redirect()->route('senarai_data')
        ->with('success-update', 'Rekod berjaya disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteData($id)
    {
        // Delete Data
        DB::table('data')->where('id_data', $id)->delete();

        // Response
        return redirect()->route('senarai_data')
        ->with('success-delete', 'Rekod berjaya dihapuskan!');
    }
}
