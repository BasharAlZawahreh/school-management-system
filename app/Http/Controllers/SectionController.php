<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('sections')->get();
        return view('sections.sections', [
            'grades' => $grades,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $attributes = $request->validate([
                'Name_Section_Ar' => 'required',
                'Name_Section_En' => 'required',
                'Grade_id' => 'required',
                'Class_id' => 'required',
            ]);


            Section::create([
                'name' => ['ar' => $attributes['Name_Section_Ar'], 'en' => $attributes['Name_Section_En']],
                'grade_id' => $attributes['Grade_id'],
                'class_id' => $attributes['Class_id'],
                'status' => 1
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $section->update([
                'name' => ['ar' => $request['Name_Section_Ar'], 'en' => $request['Name_Section_En']],
                'grade_id' => $request['Grade_id'],
                'grade_id' => $request['Class_id'],
                'status' => $request['Status'] ? 1 : 0
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
