<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\HseChecklist;
use Illuminate\Http\Request;

class HseChecklistController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal mulai dan tanggal akhir dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk mendapatkan data berdasarkan rentang tanggal
        $query = HseChecklist::query();

        // Jika tanggal mulai dan tanggal akhir diisi, tambahkan filter
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        // Ambil data
        $reports = $query->get();

        return view('report.data', compact('reports'));
    }
    public function store(Request $request)
    {
        // Validasi data form (opsional, bisa tambahkan sesuai kebutuhan)
        $request->validate([
            'date' => 'required|date',
            'reported_by' => 'required|string|max:255',
            'inst_dept' => 'required|string|max:255',
            'condition_status' => 'nullable|array',
            // Tambahkan validasi lainnya jika diperlukan
        ]);

        // Menyimpan data menggunakan model
        HseChecklist::create([
            'date' => $request->input('date'),
            'reported_by' => $request->input('reported_by'),
            'inst_dept' => $request->input('inst_dept'),
            'condition_status' => json_encode($request['condition_status']),
            'ppe' => $request->input('ppe'),
            'working_position' => $request->input('working_position'),
            'ergonomic_health' => $request->input('ergonomic_health'),
            'tools_equipment' => $request->input('tools_equipment'),
            'procedures' => $request->input('procedures'),
            'environment_housekeeping' => $request->input('environment_housekeeping'),
        ]);

        return redirect()->back()->with('success', 'Checklist HSE berhasil disimpan.');
    }
    public function show($id)
    {
        $report = HseChecklist::findOrFail($id);
        return view('report.show', compact('report'));
    }
    public function exportToPDF($id)
    {
        // Ambil laporan berdasarkan ID
        $report = HseChecklist::findOrFail($id);

        // Muat view dan kirim data
        $pdf = PDF::loadView('reports.pdf', compact('report'));

        // Download PDF
        return $pdf->download('report.pdf');
    }
}
