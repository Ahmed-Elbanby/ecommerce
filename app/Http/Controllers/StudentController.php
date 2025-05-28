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
use Illuminate\Support\Facades\Toastr;

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
            'email' => ['required', 'email', 'unique:students'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required'],
            'birth_day' => ['required', 'date'],
            'image' => ['nullable'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'nationality_id' => ['required', 'exists:nationalities,id'],
            'parent_id' => ['required', 'exists:my__parents,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $student = Student::create($data);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('students', 'public');
        //     $student->image = $imagePath;
        //     $student->save();
        // }

        if ($request->hasFile('image')) {
            // try {
            //     $imagePath = $request->file('image')->store('', 'attachments');
            //     $student->image = $imagePath;
            //     $student->save();
            // } catch (\Exception $e) {
            //     toastr()->error('Error storing image: ' . $e->getMessage());
            //     return redirect()->back();
            // }
            $this->storeImage($student, $request->file('image'), true);
        }

        // Handle multiple attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $this->storeImage($student, $file);
            }
        }

        // if ($request->hasFile('photos')){
        //     foreach($request->file('photo') as $file){
        //         $name = $file->getClientOriginalName();
        //         $file->storeAs('attachments/students/'.$student->name, $file->getClientOriginalName(), 'upload attachments');

        //         Image::create([
        //             'filename'=>$name,
        //             'imageable_id'=>$student->id,
        //             'imageable_type'=>Student::class,
        //         ]);
        //     }
        // }


        toastr()->success('Student created successfully');
        return redirect()->route('student.index');
    }

    private function storeImage(Student $student, $file, $isProfile = false)
    {
        $originalName = $file->getClientOriginalName();

        // Generate new filename
        $newFilename = $student->email . ' - ' . $originalName;

        // Store file
        $path = $file->storeAs(
            $student->email,
            $newFilename,
            'student_attachments'
        );

        // Create image record first to get ID
        $image = Image::create([
            'filename' => $newFilename,
            'path' => $path,
            'imageable_id' => $student->id,         // Add this
            'imageable_type' => Student::class,     // Add this
        ]);

        // Update image record if needed
        if ($isProfile) {
            $student->update(['image' => $path]);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $student = Student::with(['faculty', 'classroom', 'section', 'nationality', 'parent', 'doctor'])
    //                      ->findOrFail($id);
    //     return view('pages.student.show', ['student' => $student]);
    // }

    public function show(Student $student)
    {
        $student->load(['faculty', 'classroom', 'section', 'nationality', 'parent', 'doctor', 'images']);
        return view('pages.student.show', compact('student'));
    }

    // public function destroyAttachment(Student $student, Image $image)
    // {
    //     Storage::disk('attachments')->delete($image->filename);
    //     $image->delete();
    //     toastr()->success('Attachment deleted successfully');
    //     return back();
    // }

    // public function downloadAttachment(Student $student, Image $image)
    // {
    //     $path = storage_path('app/attachments/'.$student->email.'/'.$image->filename);
    //     return response()->download($path);
    // }

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
            'name',
            'email',
            'gender',
            'birth_day',
            'faculty_id',
            'classroom_id',
            'section_id',
            'nationality_id',
            'parent_id',
            'doctor_id'
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

    public function Upload_attachment(Request $request, Student $student)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $name = $file->getClientOriginalName();
                // $file->storeAs('attachments/students/'.$student->name, $file->getClientOriginalName(), 'upload attachments');
                $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $name);

                $path = $file->storeAs($student->email, $safeName, 'student_attachments');

                Image::create([
                    'filename' => $safeName,
                    'path' => $path,
                    'imageable_id' => $student->id,         // Add this
                    'imageable_type' => Student::class,     // Add this
                ]);
            }
        }
        toastr()->success('UPDATE Success');
        return redirect()->route('student.show', $student->id);

        // dd($request->all());
    }

    // public function Download_attachment($studentsname, $filename)
    // {
    //     // return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    //     $path = base_path("attachments/students/{$studentsname}/{$filename}");
    //     return response()->download($path);
    // }
    // public function Download_attachment(Student $student, $filename)
    // {
    //     $path = base_path("attachments/students/{$student->email}/{$filename}");

    //     if (!file_exists($path)) {
    //         abort(404);
    //     }

    //     return response()->download($path);
    // }

    public function Download_attachment(Student $student, $filename)
    {
        $image = Image::where('filename', $filename)
            ->where('imageable_id', $student->id)
            ->firstOrFail();

        return Storage::disk('student_attachments')->download($image->path);
    }

    public function destroyAttachment(Student $student, Image $image)
    {
        // Verify the image belongs to the student
        if ($image->imageable_id !== $student->id) {
            abort(403, 'Unauthorized action');
        }

        Storage::disk('student_attachments')->delete($image->path);
        $image->delete();

        toastr()->success('Attachment deleted successfully');
        return back();
    }
}
