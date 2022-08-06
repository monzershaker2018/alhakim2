<?php

namespace App\Http\Controllers;

use App\Models\Halaqa;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaqats = Halaqa::all();
       $students = Student::all();
    return view('Pages.students.students' , compact('halaqats' , 'students'));
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:students,name',
           ]);
           Student::create($request->all());
            $notification = array(
                'message' => 'تم إضافة البيانات بنجاح',
                'alert-type' => 'success'
            );
            return redirect()-> route('students.index')->with($notification);
    }

    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:students,name,'.$request->id,
       ]);
       Student::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('students.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        Student::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('students.index')->with($notification);
    }
}
