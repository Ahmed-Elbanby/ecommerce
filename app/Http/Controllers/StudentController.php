<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Nationalitie;
use App\Models\My_Parent;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::query();

        if ($request->has("search")) {
            $search = $request->input("search");
            $students->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $students = $students->get();

        if ($request->ajax()) {
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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required'],
            'birth_day' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'nationality_id' => ['required', 'exists:nationalities,id'],
            'parent_id' => ['required', 'exists:my__parents,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $student = Student::create($data);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
            $student->image = $imagePath;
            $student->save();
        }

        toastr()->success('Student created successfully');
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with(['faculty', 'classroom', 'section', 'nationality', 'parent', 'doctor'])
                         ->findOrFail($id);
        return view('pages.student.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('pages.student.edit', [
            'student' => $student,
            'faculties' => Faculty::all(),
            'classrooms' => Classroom::all(),
            'sections' => Section::all(),
            'nationalities' => Nationalitie::all(),
            'parents' => My_Parent::all(),
            'doctors' => Doctor::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'gender' => 'required|in:male,female',
            'birth_day' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'faculty_id' => 'required|exists:faculties,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'parent_id' => 'required|exists:my__parents,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $imagePath = $request->file('image')->store('students', 'public');
            $student->image = $imagePath;
        }

        $student->update($request->only([
            'name', 'email', 'gender', 'birth_day', 
            'faculty_id', 'classroom_id', 'section_id',
            'nationality_id', 'parent_id', 'doctor_id'
        ]));

        toastr()->success('Student updated successfully');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $student->delete();
        toastr()->success('Student deleted successfully');
        return redirect()->route('student.index');
    }
}