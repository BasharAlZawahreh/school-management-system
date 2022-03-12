<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('classrooms')->get();
        $classes = Classroom::with('grade')->get();

        return view('classes.classes', [
            'classes' => $classes,
            'grades' => $grades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        try {
            foreach ($request['List_Classes'] as $class) {
                Classroom::create([
                    'name' => ['en' => $class['Name_class_en'], 'ar' => $class['Name']],
                    'grade_id' =>  $class['Grade_id'],
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        try {
            $classroom->update([
                'name' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'grade_id' => $request['Grade_id']
            ]);


            toastr()->success(trans('messages.Update'));
            return redirect()->route('classrooms.index');
        } catch (Exception $e) {
            toastr()->success(trans($e->getMessage()));

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroomId)
    {
        try {
            Classroom::destroy($classroomId);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('Something went wrong!!');
        }
    }

    public function destroyAll(Request $request)
    {
        try {
            $selected = explode(',',$request['delete_all_id']);
            Classroom::destroy($selected);

            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('Something went wrong!!');
        }
    }

    public function filter(Request $request)
    {
        $grades = Grade::all();
        $search = Classroom::where('grade_id',$request->grade_id)->get();

        return view('classes.classes',[
                        'grades' => $grades
                 ])->withDetails($search);
    }

    public function getGradeClassrooms(Grade $grade)
    {
       return Classroom::where('grade_id',$grade->id)->pluck('name','id');
    }
}
