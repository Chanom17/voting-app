<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VoterController extends Controller
{
    public function voteIndex()
    {
        $candidates = Candidate::all();
        $voter = null;
        if (Session::has('loginVoter')) {
            $voter = Voter::where('id', '=', Session::get('loginVoter'))->first();
        }
        return view('vote', compact('candidates', 'voter'));
    }

    public function vote($candidate_id, $voter_id)
    {
        $candidate = Candidate::find($candidate_id);
        if ($candidate) {
            $candidate->increment('votes');

            $voter = Voter::find($voter_id);
            if ($voter) {
                $voter->voted = true;
                $voter->save();

                return view('voted', compact('candidate', 'voter'));
            }
        } else {
            return redirect()->back()->with('Error', 'Failed to submit vote.');
        }
    }

    public function index()
    {
        $voters = Voter::all();

        return view('voter.index_voter', compact('voters'));
    }

    public function edit($id)
    {
        $voter = Voter::find($id);
        return view('voter.edit_voter', compact('voter'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'identify_id' => 'required|min:13|max:13',
            'birthday' => 'required|date|before_or_equal:-18 years',
        ]);

        $voter = Voter::find($request->id);

        if (!$voter) {
            return back()->with('Fail', 'Voter not found');
        }

        $voter->name = $request->name;
        $voter->identify_id = $request->identify_id;
        $voter->voted = $request->voted;

        if ($request->birthday) {
            list($day, $month, $year) = explode('/', $request->birthday);
            $formatted_birthday = "$year-$month-$day";
            $voter->birthday = $formatted_birthday;
        }

        if (!$request->voted) {
            $voter->voted = false;
        }

        $answer = $voter->save();

        if ($answer) {
            return back()->with('Success', 'Voter has updated successfully');
        }
        return back()->with('Fail', 'Voter is not update');
    }

    public function delete($id)
    {
        $voter = Voter::find($id);
        $voter->delete();

        return back()->with('Success', 'Voter has deleted successfully');
    }
}
