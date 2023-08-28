<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sinhvien;

class SinhvienController extends Controller
{
    function show(){
        $data = sinhvien::all();
        return view('list',['sinhviens'=>$data]);
    }
}
