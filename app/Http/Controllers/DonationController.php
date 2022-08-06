<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {


        $donations = Donation::all();
     return view('Pages.donations.donations' , compact( 'donations'));


    }

    public function store(Request $request)
    {
      // return $request -> all();
    //   $this->validate($request , [
    //     'name' => 'required|min:3|max:70 |unique:expenses,name',
    //    ]);
    Donation::create($request->all());
        $notification = array(
            'message' => 'تم إضافة البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('donations.index')->with($notification);
    }



    public function update(Request $request)
    {
    //     $this->validate($request , [
    //         'name' => 'required|min:3|max:70 |unique:admins,name,'.$request->id,
    //    ]);
    Donation::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('donations.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        Donation::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('donations.index')->with($notification);
    }
}
