<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        //
        $users = User::all();
        return view('Pages.users.users' , compact('users'));
    }




    public function store(Request $request)
    {
       $this->validate($request , [
        'name' => 'required|min:3|max:70 ',
        'email' => 'required|min:3|max:70 |unique:users,email',
        'password' => 'required|min:3|max:70 |confirmed',
       ]);

        User::create($request->all());
       $notification = array(
        'message' => 'تم إضافة البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('users.index')->with($notification);

    }




    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 ',
        'email' => 'required|min:3|max:70 |unique:users,email,'.$request->id,


       ]);
      User::findOrFail($request->id)->update([
        'name' => $request->name,
        'email' => $request->email,


      ]);
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('users.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        User::findOrFail($request->id)->delete();
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('users.index')->with($notification);
    }
}
