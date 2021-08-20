<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::get();
        return view('welcome')->with('students', $students);
    }

    public function register(Request $request) 
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $hobbies = $request->get('hobbies');
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'hobbies' => 'required',
        ]);

        $std            = new Students;
        $std->name      = $name;
        $std->email     = $email;
        $std->hobbies   = json_encode($hobbies);
        $std->save();

        return redirect('/')->with('status', 'Successful!');
    }
}
