<?php 
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Student; //add Student Model - Data is coming from the database via Model.
use App\Http\Controllers\StudentController;

class StudentController extends Controller
{ 
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $students = Student::all();
    //     return view ('students.index')->with('students', $students);
    // }

    public function index(Request $request)
    {
        $search = $request->search;
        $students = Student::when($search,function($query,$search){
        return $query   ->where('fname','like',"%{$search}%");
        })->paginate(25);
        return view ('students.index')->with('students', $students);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {
        return view('students.create');
    }
 
    /**
     * Store a newly created resource in storage. 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Student::create($input);
        return redirect('student')->with('flash_message', 'Student Addedd!');  
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('students.show')->with('students', $student);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit')->with('students', $student);
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
        $student = Student::find($id);
        $input = $request->all();
        $student->update($input);
        return redirect('student')->with('flash_message', 'student Updated!');  
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);
        return redirect('student')->with('flash_message', 'Student deleted!');  
    }

    // public function delete($id)
    // {
    //     $student = Student::find($id);
    //     $student->delete();
    //     return redirect('student')->with('flash_message', 'Student deleted!');  
    //     //return redirect('/');
    // }
}