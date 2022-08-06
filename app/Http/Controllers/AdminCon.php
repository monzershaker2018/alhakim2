<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $admins = Admin::all();
     return view('Pages.admins.admins' , compact( 'admins'));


    }

    public function store(Request $request)
    {
      // return $request -> all();
      $this->validate($request , [
        'name' => 'required|min:3|max:70 |unique:admins,name',
       ]);
       Admin::create($request->all());
        $notification = array(
            'message' => 'تم إضافة البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('admins.index')->with($notification);
    }



    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:admins,name,'.$request->id,
       ]);
       Admin::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('admins.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        Admin::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('admins.index')->with($notification);
    }
}
