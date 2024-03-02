<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class ChartController extends Controller
{
    public function resultChart()
    {
        $voter = null;
        if (Session::has('loginVoter')) {
            $voter = Voter::where('id', '=', Session::get('loginVoter'))->first();
        }
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        return view('chart', compact('candidates', 'voter'));
    }

    public function resultPDF()
    {
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        $pdf = PDF::loadView('pdf.result', compact('candidates'));
        return $pdf->stream();
    }

}
