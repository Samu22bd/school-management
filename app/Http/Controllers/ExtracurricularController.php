<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    //
    public function index(){
        $ekskul = Extracurricular::get();
        // p2
        // $ekskul = Extracurricular::with('ExtracurricularToStudent')->get();
        // dd($ekskul);
        
        return view('extracurricular',['exlist' => $ekskul]);
    }

    public function show($id){
        $ekskul = Extracurricular::with('ExtracurricularToStudent')->findOrFail($id);
        return view('extracurricular-detail', ['exDetail' => $ekskul]);
    }
}
