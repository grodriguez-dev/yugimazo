<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('course', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $courses = Course::all();
        return view('course_create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {   
        $courses = new Course;

        if($request->hasFile('image')){

            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/img/';        
            $file->move($path,$img);
        }

        $courses->title = $request->title;
        $courses->description = $request->description;
        $courses->teacher = $request->teacher;
        $courses->skill = $request->skill;
        $courses->platform = $request->platform;
        $courses->duration = $request->duration;
        $courses->repository = $request->repository;
        $courses->image = $img ?? null;
        $courses->save();

        return redirect()
            ->route('courses.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course_e = Course::where('id', $id)->first();
        $courses = Course::all();
        return view('course_create', compact('course_e', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $img = uniqid().'-'.$file->getClientOriginalName();
            $path = public_path() .'/assets/img/';        
            $file->move($path,$img);

            $image = public_path('/assets/img/'.$request->hiddenimg);

            if (@getimagesize($image)) {

                unlink(public_path('/assets/img/'.$request->hiddenimg));
            }

        } else {
            $img = $request->hiddenimg;
        }

        Course::where('id', $id)
          ->update([
            'title' => $request->title,
            'description' => $request->description,
            'teacher' => $request->teacher,
            'skill' => $request->skill,
            'platform' => $request->platform,
            'duration' => $request->duration,
            'repository' => $request->repository,
            'image' => $img ?? null,
        ]);

        return redirect()
            ->route('courses.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::where('id', $id)->first();

        $image = public_path('/assets/img/'.$course->image);
        
        if (@getimagesize($image)) {
            unlink(public_path('/assets/img/'.$course->image));
        }

        $course->delete();
        return redirect()->route('courses.create');
    }
}
