<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\NullableType;

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
        $transaksi=$request->user()->transaksi()->find($id);

        if(!$transaksi){
            return response()->json([
                'message'=>'Transaksi tidak ditemukan',
            ],404);
        }

        return response()->json($transaksi,200);
    }

    public function update(Request $request, int $id){
        $transaksi=$request->user()->transaksi()->find($id);

        if(!$transaksi){
            return response()->json([
                'message'=> 'Transakasi tidak ditemukan',
            ],404);
        }

        $request->validate([
            'jenis'=>'sometimes|in:pemasukan,pengeluaran',
            'nominal'=>'sometimes|numeric|min:1',
            'metode'=>'sometimes|in:tunai,digital',
            'tanggal'=>'sometimes|date',
            'catatan'=>'nullable|string|max:100',
        ]);

        $transaksi->update($request->only(['jenis','nominal','metode','tanggal','catatan']));

        return response()->json([
            'message'=>'Transaksi berhasil diperbarui',
            'transaksi'=>$transaksi,
        ],200);
    }
}