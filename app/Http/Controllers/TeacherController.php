<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\teacher; //add Student Model - Data is coming from the database via Model.
use App\Http\Controllers\TeacherController;

class TeacherController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->search;
        $teachers = teacher::when($search,function($query,$search){
        return $query   ->where('fname','like',"%{$search}%");
        })->paginate(30);
        return view ('teachers.index')->with('teachers', $teachers);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }
 
    /**
     * Store a newly created resource in storage. 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        teacher::create($input);
        return redirect('teacher')->with('flash_message', 'Teacher Addedd!');  
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = teacher::find($id);
        return view('teachers.show')->with('teacher', $teacher);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = teacher::find($id);
        return view('teachers.edit')->with('teacher', $teacher);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacher = teacher::find($id);
        $input = $request->all();
        $teacher->update($input);
        return redirect('teacher')->with('flash_message', 'teacher Updated!');  
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        teacher::destroy($id);
        return redirect('teacher')->with('flash_message', 'Teacher deleted!');  
    }

}
