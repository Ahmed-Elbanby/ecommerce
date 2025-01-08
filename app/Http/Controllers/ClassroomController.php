<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::with('faculty')->get();
        // $faculties = Faculty::all();
        return view('pages.classroom.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('pages.classroom.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'faculty_id' => 'required',
            ]);
            Classroom::create($validated);

            toastr()->success('Classroom Created Successfully');
            return redirect()->route('classroom.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $faculties = Faculty::all();
        return view('pages.classroom.edit', compact('classroom', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validate = $request->validate([
            'name' => 'required',
            'faculty_id' => 'required',
        ]);
        $classroom->update($validate);
        toastr('Classroom Updated Successfully');
        return redirect()->route('classroom.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        // $classroom = Classroom::findOrFail($request->id)->delete();
        $classroom->delete();
        toastr()->success('Classroom Deleted Successfully');
        return redirect()->route('classroom.index');
    }

    // public function getClassrooms($faculty_id)
    // {
    //     $classrooms = ClassroomController::where('faculty_id', $faculty_id)->get();
    //     return response()->json($classrooms);
    // }

    // public function getClassrooms(Request $request, $facultyId)
    // {
    //     $faculty = Faculty::find($facultyId);
    //     if ($faculty) {
    //         $classrooms = $faculty->classrooms; // Eloquent handles the database query
    //         return response()->json($classrooms);
    //     } else {
    //         return response()->json([], 404); //Faculty not found
    //     }
    // }

    public function getClassrooms($faculty_id)
    {
        $classrooms = Classroom::where('faculty_id', $faculty_id)->get();
        return response()->json($classrooms);
    }

}
