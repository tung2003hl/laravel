<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    function show(){
        $data = student::all();
        return view('list',['students'=>$data]);
    }
}
