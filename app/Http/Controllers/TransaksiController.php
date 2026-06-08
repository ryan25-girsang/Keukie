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
    }
}