<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Nationalitie;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::all();

        if($request->has('search')) {
            $doctors = Doctor::where( 'email', 'like', "%{$request->search}%")->onwhere( 'email', 'like', "%{$request->search}%");
        }

        return view('pages.dr.index',compact('doctors'),[
            'doctors'=>Doctor::all(),
            'nationalities'=>Nationalitie::all(),
            'faculties'=>Faculty::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dr.create',compact('doctors'),[
            'nationalities'=>Nationalitie::all(),
            'faculties'=>Faculty::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'faculty_id' => ['required'],
            'classroom_id' => ['required'],
            'section_id' => ['required'],
            'nationality_id' => ['required'],
        ]);
        Doctor::create($data);
        toastr()->success('success');
        return redirect()->route('Dr.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
