<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function resultChart()
    {
        $candidates = Candidate::orderBy('votes', 'desc')->get();
        return view('chart', compact('candidates'));
    }
}
