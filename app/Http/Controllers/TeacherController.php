<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function index(){
        $teacher = Teacher::all();
        return view('teacher', ['teacherList' => $teacher]);
    }

    public function show($id){
        $teacher = Teacher::with('TeacherToClass.ClassToStudents')->findOrFail($id);
        return view('teacher-detail',['tDetail' => $teacher]);
    }
}
