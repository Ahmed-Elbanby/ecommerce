<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('pages.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        // $validated = $request->validated();


        $validated = $request->validate([ // Use validate instead of validated.  Validated is only for requests that already passed validation.
            'name' => 'required', // Add validation rules as needed.
            'note' => 'nullable', //Allow note to be null
        ]);
        Faculty::create($validated); //Simplified creation


        // $faculty = new Faculty();
        // $faculty->name = $request->Name;
        // $faculty->note = $request->Note;
        // $faculty->save();

        toastr()->success('Faculty Added Successfully');
        return redirect()->route('faculty.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('pages.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        try{
            // $faculty = Faculty::findOrFail($request->id);
            // $faculty->update([
            //     $faculty->name = $request->name,
            //     $faculty->note = $request->note,
            // ]);


            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'note' => 'nullable|string',
            ]);

            $faculty->update($validated);


            toastr()->success('Faculty Updated Successfully.');
            return redirect()->route('faculty.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Faculty $faculty)
    {
        $faculty = Faculty::findOrFail($request->id)->delete();
        toastr()->success('Faculty Deleted Successfully');
        return redirect()->route('faculty.index');
    }
}
