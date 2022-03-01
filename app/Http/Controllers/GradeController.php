<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use Exception;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grades.grades', [
            'grades' => Grade::all()
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
     * @param  \App\Http\Requests\StoreGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeRequest $request)
    {
        try {

            Grade::create([
                'name' =>  ['en' => $request->Name_en, 'ar' => $request->Name],
                'notes' => $request->Notes
            ]);

            toastr()->success(trans('messages.success'));


            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error('Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradeRequest  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        try {
            $grade->update([
                'name' =>  ['en' => $request->Name_en, 'ar' => $request->Name],
                'notes' => $request->Notes
            ]);

            toastr()->success(trans('messages.Update'));

            return redirect()->back();

        } catch (Exception $e) {
            toastr()->error('Error');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        try {
            $grade->delete();

            toastr()->success(trans('messages.Delete'));

            return redirect()->back();

        } catch (Exception $e) {
            toastr()->error('Error');

            return redirect()->back();
        }
    }
}
