<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentSubject; //add Student Model - Data is coming from the database via Model.
use App\Models\Subject; //add Student Model - Data is coming from the database via Model.
use App\Http\Controllers\studentSubjectController;

class studentSubjectController extends Controller
{
     
    public function index(Request $request)
    {
        $search = $request->search;
        $studentSubjects = studentSubject::when($search,function($query,$search){
        return $query   ->where('subjectID','like',"%{$search}%");
        })->paginate(30);
        return view ('studentSubject.index')->with('studentSubject', $studentSubjects);
    }
  
    public function create()
    {  
        return view('studentSubject.create'); 
    } 

    public function store(Request $request)
    {
        $input = $request->all();
        studentSubject::create($input);
        return redirect('studentSubject')->with('flash_message', 'student subject created!');  
    }
     
    public function show($id)
    {
        $studentSubjects = studentSubject::find($id);
        return view('studentSubject.show')->with('studentSubject', $studentSubjects);
    }

    public function edit($id)
    {
        $studentSubjects = studentSubject::find($id);
        return view('studentSubject.edit')->with('studentSubject', $studentSubjects);
    } 

    public function update(Request $request, $id)
    {
        $studentSubjects = studentSubject::find($id);
        $input = $request->all();
        $studentSubjects->update($input);
        return redirect('studentSubject')->with('flash_message', 'Std subject Updated!');  
    }
  
    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect('studentSubject')->with('flash_message', 'Std Subject deleted!');  
    }
}
