<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Halaqa;
use Illuminate\Http\Request;

class HalaqaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $halaqats = Halaqa::all();
       $admins = Admin::all();
    return view('Pages.halaqats.halaqats' , compact('halaqats' , 'admins'));
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:halaqas,name',
           ]);

        $admin = $request->admin;
    if(is_array($admin))
    {
        $admin = implode(' , ', $admin);

    }


       $halaqats = new Halaqa();
       $halaqats->name = $request -> name;

       $halaqats->admin = json_encode($admin);
       $halaqats->save();
        // Halaqa::create( $input);
        Halaqa::create($request->all());
        $notification = array(
            'message' => 'تم إضافة البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('halaqats.index')->with($notification);
    }



    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:halaqas,name,'.$request->id,
       ]);
       Halaqa::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('halaqats.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        Halaqa::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('halaqats.index')->with($notification);
    }
}
