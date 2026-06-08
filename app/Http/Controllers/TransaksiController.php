<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'nominal' => 'required|numeric|min:1',
            'metode' => 'required|in:tunai,digital',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string|max:100',
        ]);

        $transaksi=$request->user()->transaksi()->create([
            'jenis'=>$request->jenis,
            'nominal'=>$request->nominal,
            'metode'=>$request->metode,
            'tanggal'=>$request->tanggal,
            'catatan'=>$request->catatan,
        ]);

        return response()->json([
            'message'=>'Transaksi berhasil ditambahkan',
            'transaksi'=>$transaksi,
        ],201);
    }

    public function index(Request $request){
        $transaksi=$request->user()->transaksi()->orderBy('tanggal','desc')->get();
        return response()->json($transaksi,200);
    }

    public function show(Request $request,int $id){
        
    }
}