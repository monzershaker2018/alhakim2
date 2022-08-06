<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ChanePass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login');
    }

    public function indexed()
    {
        return view('Pages.index');
    }




    public function change(Request $request)
    {
       // return $request;

        $request->validate( [

            'current_password' => ['required', new ChanePass],
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'same:new_password',
        ]);

               User::find(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password)

               ]);


                $notification = array(
                    'message' => 'تم تغيير كلمة المرور بنجاح',
                    'alert-type' => 'success'
                );
                return redirect('/dashboard/index')->with($notification);

}


public function change_password(){
    return view('Pages.change');
}

}
