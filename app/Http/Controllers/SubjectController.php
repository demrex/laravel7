<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject; //add Student Model - Data is coming from the database via Model.
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{ 
      
    public function index(Request $request)
    {
        $search = $request->search;
        $subjects = subject::when($search,function($query,$search){
        return $query   ->where('subjectTitle','like',"%{$search}%");
        })->paginate(30);
        return view ('subjects.index')->with('subjects', $subjects);
    } 
    public function create()
    {
        return view('subjects.create');
    }
 
    
    public function store(Request $request)
    {
        $input = $request->all();
        Subject::create($input);
        return redirect('subject')->with('flash_message', 'Subject Added!');  
    }
 
     
    public function show($id)
    {     
        $subjects = Subject::find($id);  
        $sid = DB::table('subjects')->where('id',$id)->value('subjectID');  
        $students = DB::select("SELECT students.studentID, students.fname, students.lname,students.nickname FROM student_subjects RIGHT JOIN students ON student_subjects.studentID=students.studentID WHERE student_subjects.subjectID='$sid'");

        return view('subjects.show', compact(['subjects','students']));
    }
 
     
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subjects.edit')->with('subjects', $subject);
        
    }
   
    public function update(Request $request, $id)
    {
        $subjects = Subject::find($id);
        $input = $request->all();
        $subjects->update($input);
        return redirect('subject')->with('flash_message', 'subject Updated!');  
    }
  
    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect('subject')->with('flash_message', 'Subject deleted!');  
    }

    public function indexStudents()
    {
        $students = DB::select('SELECT students.studentID, students.fname, students.lname,students.nickname FROM student_subjects RIGHT JOIN students ON student_subjects.studentID=students.studentID WHERE student_subjects.subjectID="1001"');
 
        return view('subjects.indexStudents', ['students' => $students]);
    }
}
