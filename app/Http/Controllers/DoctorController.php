<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
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

        return view('pages.doctor.index',compact('doctors'),[
            'doctors'=>Doctor::all(),
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
        $doctors = Doctor::all();

        return view('pages.doctor.create',compact('doctors'),[
            'faculties'=>Faculty::all(),
            'classrooms'=>Classroom::all(),
            'sections'=>Section::all(),
        ]);
    }

    public function store(Request $request)
{
    // dd($request->all());

    $data = $request->validate([
        'name' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:doctors,email'],
        'password' => ['required', 'string', 'min:8'],
        'faculty_id' => ['required', 'exists:faculties,id'],
        'classroom_id' => ['required', 'exists:classrooms,id'],
        'section_id' => ['required', 'exists:sections,id'],
    ]);

    Doctor::create($data);
    toastr('Doctor Created Successfully');
    return redirect()->route('doctor.index');
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
        $faculties = Faculty::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        return view('pages.doctor.edit', compact('doctor', 'faculties', 'classrooms', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:doctors,email,' . $doctor->id,
            'password' => 'nullable|string|min:8',
            'faculty_id' => 'required|exists:faculties,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $doctor->password,
            'faculty_id' => $request->faculty_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
        ]);
        toastr('Doctor Updated Successfully');
        return redirect()->route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        toastr('Doctor Deleted Successfully');
        return redirect()->route('doctor.index');
    }
}
