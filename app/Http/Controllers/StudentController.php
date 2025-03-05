<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Nationalitie;
use App\Models\My_Parent;
use App\Models\Doctor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $students = Student::all();
        $students = Student::query();

        if ($request->has("search")) {
            // $students = Student::where('name', 'like', "%{$request->searrch}%")
            //             ->orwhere('email', 'like', "%{$request->searrch}%");
            $search = $request->input("search");
            $students->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $students = $students->get();

        // Check if the request is an AJAX request
    if ($request->ajax()) {
        // Return only the table rows as HTML
        return view('pages.student.partials.students_table_rows', ['students' => $students]);
    }

        return view('pages.student.index', [
            'students' => $students,
            'faculties' => Faculty::all(),
            'classrooms' => Classroom::all(),
            'sections' => Section::all(),
            'nationalities' => Nationalitie::all(),
            'parents' => My_Parent::all(),
            'doctors' => Doctor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.student.create', [
            'faculties' => Faculty::all(),
            'classrooms' => Classroom::all(),
            'sections' => Section::all(),
            'nationalities' => Nationalitie::all(),
            'parents' => My_Parent::all(),
            'doctors' => Doctor::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $hashedPassword = Hash::make($request->password);

        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email', 'max:255'],
            'password' => ['string', 'required', 'min:8'],
            'gender' => ['required'],
            'birth_day' => ['required'],
            'faculty_id' => ['required'],
            'classroom_id' => ['required'],
            'section_id' => ['required'],
            'nationality_id' => ['required'],
            'parent_id' => ['required'],
            'doctor_id' => ['required'],
        ]);

        $data['password'] = Hash::make($data['password']);

        Student::create($data);

        toastr()->success('success');

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $faculties = Faculty::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $nationalities = Nationalitie::all();
        $parents = My_Parent::all();
        $doctors = Doctor::all();
        return view('pages.student.edit', compact('student', 'faculties', 'classrooms', 'sections', 'nationalities', 'parents', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'gender' => 'required|in:male,female',
            'birth_day' => 'required|date',
            'faculty_id' => 'required|exists:faculties,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'parent_id' => 'required|exists:my__parents,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        // Find the student by ID
        $student = Student::findOrFail($student->id);

        // Update the student data
        $student->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'birth_day' => $request->input('birth_day'),
            'faculty_id' => $request->input('faculty_id'),
            'classroom_id' => $request->input('classroom_id'),
            'section_id' => $request->input('section_id'),
            'nationality_id' => $request->input('nationality_id'),
            'parent_id' => $request->input('parent_id'),
            'doctor_id' => $request->input('doctor_id'),
            'status' => $request->input('status', 'active'), // Default to 'active' if not provided
        ]);

        // Redirect with a success message
        toastr('Student Updated Successfully');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student = Student::findOrFail($student->id);

        // Delete the student
        $student->delete();

        // Redirect with a success message
        toastr('Student deleted successfully');
        return redirect()->route('student.index');
    }
}
