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
            'name' => ['string', 'required', 'max:20'],
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
