<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    //
    public function show($id){
        $class = ClassRoom::with('ClassToStudents','ClassToTeacher')->findOrFail($id);
        return view('class-detail', ["clDetail" => $class]);
    }

    public function index(){
        // lazy load
        // cara requestnya = ketika dibutuhkan, ambil data
        // $class = ClassRoom::all();
        
        // Select * from table class
        // Select * from student where class = 1A
        // Select * from student where class = 1B
        // Select * from student where class = 1C
        // Select * from student where class = 1D


        $class = ClassRoom::get();

        // eager load
        // phase 2
        // $class = ClassRoom::with('ClassToStudents','ClassToTeacher')->get();
        return view("/classroom", ['classList' => $class]);
        // Select * from table class
        // Select * from student where class in (1A, 1B, 1C, 1D)
    }
}
