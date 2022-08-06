<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {


        $expenses = Expenses::all();
     return view('Pages.expenses.expenses' , compact( 'expenses'));


    }

    public function store(Request $request)
    {
    // return $request -> all();
    //   $this->validate($request , [
    //     'name' => 'required|min:3|max:70 |unique:expenses,name',
    //    ]);
       Expenses::create($request->all());
        $notification = array(
            'message' => 'تم إضافة البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('expenses.index')->with($notification);
    }



    public function update(Request $request)
    {
    //     $this->validate($request , [
    //         'name' => 'required|min:3|max:70 |unique:admins,name,'.$request->id,
    //    ]);
       Expenses::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('expenses.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        Expenses::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('expenses.index')->with($notification);
    }
}
