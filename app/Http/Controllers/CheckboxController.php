<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckboxController extends Controller
{
    public function submitCheckbox(Request $request)
    {
        // Ambil data dari checkbox
        $ppe = $request->input('ppe', []);
        $working_position = $request->input('working_position', []);
        $ergonomic = $request->input('ergonomic', []);

        // Contoh: menyimpan data ke database (sesuaikan dengan tabelmu)
        // DB::table('checkbox_selections')->insert([...]);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}

