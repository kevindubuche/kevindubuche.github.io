<?php

namespace App\Http\Controllers;
use App\User;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $admins = User::all();
        return view('admin.index', compact('admins'));
    }

   
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if (empty($admin)) {
            Session::flash('error', 'ERROR ! Admin non touve'); 
            return redirect(route('admin.index'));
        }

        User::where('id', $id)->delete();
        Session::flash('succes', 'SUCCES !'); 
        return redirect(route('admin.index'));
    }
}
