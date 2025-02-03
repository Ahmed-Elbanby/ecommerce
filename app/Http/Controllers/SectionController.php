<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        return view('pages.section.index', compact('faculties', 'classrooms', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        $classrooms = Classroom::all();
        return view('pages.section.create', compact('faculties', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'status' => 'required',
                'faculty_id' => 'required',
                'classroom_id' => 'required',
            ]);
            Section::create($validated);

            toastr()->success('Section Created Successfully');
            return redirect()->route('section.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $faculties = Faculty::all();
        $classrooms = Classroom::all();
        return view('pages.section.edit', compact('section', 'faculties', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validate = $request->validate([
            'name' => 'required',
            'faculty_id' => 'required',
            'classroom_id' => 'required',
        ]);
        $section->update($validate);
        toastr('Section Updated Successfully');
        return redirect()->route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        toastr()->success('Section Deleted Successfully');
        return redirect()->route('section.index');
    }
    public function getClassrooms(Request $request, $facultyId)
    {
        $faculty = Faculty::find($facultyId);
        if ($faculty) {
            $classrooms = $faculty->classrooms; //Using the Eloquent relationship (see previous response)
            return response()->json($classrooms);
        } else {
            return response()->json([], 404); //Faculty not found
        }
    }
}
