<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use PDF;

class ChartController extends Controller
{
    public function resultChart()
    {
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        return view('chart', compact('candidates'));
    }

    public function resultPDF()
    {
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        $pdf = PDF::loadView('pdf.result', compact('candidates'));
        return $pdf->download('result.pdf');
    }
}
