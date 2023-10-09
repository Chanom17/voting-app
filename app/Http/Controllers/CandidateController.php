<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    public function add()
    {
        return view('candidate.add_candidate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'party' => 'required',
        ]);

        $name = $request->name;
        $party = $request->party;
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $candidate = new Candidate();
        $candidate->name = $name;
        $candidate->party = $party;
        $candidate->image = $imageName;
        $candidate->save();

        return back()->with(['Candidate_Added' => 'Candidate has saved successfully']);
    }

    public function index()
    {
        $candidates = Candidate::all();
        return view('candidate.index_candidate', compact('candidates'));
    }

    public function show($id)
    {
        $candidate = Candidate::find($id);
        return view('candidate.show_candidate', compact('candidate'));
    }

    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return view('candidate.edit_candidate', compact('candidate'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'party' => 'required',
        ]);

        $name = $request->name;
        $party = $request->party;
        $candidate = Candidate::find($request->id);
        $candidate->name = $name;
        $candidate->party = $party;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $candidate->image = $imageName;
        }

        $candidate->save();

        return back()->with(['Candidate_Updated' => 'Candidate has updated successfully']);
    }

    public function delete($id)
    {
        $candidate = Candidate::find($id);
        unlink(public_path('images') . '/' . $candidate->image);
        $candidate->delete();

        return back();
    }
}
