<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class StudentController extends Controller
{
    //

    public function show($id){
        // dd($id);

        $student = Student::with('StudentToClass.ClassToTeacher', 'StudentToExtracurricular')
            ->findOrFail($id);
        return view('student-detail', ["studentDetail" => $student]);
    }

    public function create(){
        $class = ClassRoom::select('id','name')->get();
        return view('student-add', ['classList' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {
        // nama foto akan jadi random
        // return $request->file('photo')->store('photo'); 
        // kalau mau nama foto custom
        $newName = '';

        if($request->file('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name.'-'.now()->timestamp.'.'.$extension;
            $request->file('photo')->storeAs('photo', $newName);
            // return $request->file('photo')->storeAs('photo', $newName);
        }

        // validasi 
        // pindah ke app/http/requests

        // $validated = $request->validate([
        //     'name' => 'max:50|required',
        //     'gender'=> 'required',
        //     'nis' => 'unique:students|max:10|required', // ga boleh sama, di table students, max character 10
        //     'class_id' => 'required',
        // ]);

        // if(!$validated){
        //     Session::flash('status','nis gaboleh sama');
        // }

        // single assignment ->
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;

        // $student->save();

        // mass assignment ->
        // 1. perlu ngabarin ke model kolom apa aja yang boleh diisi
        // 2. Penamaan name pada form dan database harus sesuai
        // Ga perlu variabel juga bisaa
        
        // /*
        // jika name pada blade.php dan penamaan pada database beda, maka perlu dikabarin

        // $request['image'] = $newName;
        $request->image = $newName;
        $student = Student::create($request->all());

        // Session flash data
        if ($student){
            Session::flash('status', 'success'); 
            Session::flash('message', 'add new student success');
        }
        // $value = 'success';
        // $request->session()->flash('status', $value);
        // $request->session()->flash('message', 'add new student success!');

        return redirect('/students');

        // */
    }

    public function edit(Request $request, $id){
        // dd($id);
        $student = Student::with('StudentToClass')->findOrFail($id);
        // $class = ClassRoom::select('id','name')->get();
        $class = ClassRoom::where('id','!=',$student->class_id)->get(['id','name']);
        // dd($student);
        return view('student-edit', ['student' => $student, 'classList' => $class]);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        // dd($student);

        $student = Student::findOrFail($id);

        // nama variabel request sesuai name pada blade.php
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();
        

        // mass assignment
        $student->update($request->all());
        return redirect('/students');
    }

    public function delete($id){
        // dd($id);

        $student = Student::findOrFail($id);
        return view('/student-delete', ['studentData' => $student]);
    }

    public function destroy($id){
        // dd($id);

        // Query Builder
        // $deletedStudent = DB::table('students')->where('id', $id)->delete();
        // $deletedStudent = DB::table('students')->where('id', '=', $id);

        //Eloquent
        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();

        if($deletedStudent){
            Session::flash('status', 'success');
            Session::flash('message', 'delete student success!');
        }

        return redirect('/students');
    }

    public function deletedStudent(){
        $deletedStudent = Student::onlyTrashed()->get();
        return view('student-deleted-list', ['student' => $deletedStudent]);
    }

    public function restore($id){
        // dd($id);
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();

        if($deletedStudent){
            Session::flash('status', 'success');
            Session::flash('message', 'Student berhasil di restore');
        }

        return redirect('/students');
    }

    public function index(Request $request){
        // var_dump('test');
        // dd('test');

        // eloquent orm (reccomended)
        // query builder
        // raw query

        // eloquent -> bikin model dulu
        // lazy loading
        // $student = Student::all(); 
        
        // eager loading
        // $student = Student::get();

        // paginate
        // $student = Student::simplePaginate(10);
        // $student = Student::paginate(10);

        $keyword = $request->keyword;
        // dd($keyword);

        // add search
        // $student = Student::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10);
        $student = Student::with('StudentToClass')
                ->where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('gender', $keyword)
                ->orWhere('nis', 'like', '%'.$keyword.'%')
                ->orWhereHas('StudentToClass', function($query) use ($keyword){
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                })
                ->paginate(10);


        // pakai withTrashed untuk tetap menampilkan data yang sudah tersoft delete
        // $student = Student::withTrashed()->get();
        //phase 2 is 1 line below
        // $student = Student::with(['StudentToClass.ClassToTeacher','StudentToExtracurricular'])->get();
        // dd($student);
        return view('student', ["studentList" => $student]);



        // // query builder
        // // manggil data
        // $student = DB::table("students")->get();
        // dd($student);

        // // insert data
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '0201021',
        //     'class_id' => 1
        // ]);

        // // update data
        // DB::table("students")->where('id', 27)->update([
        //     'name' => 'query builder 2',
        //     'class_id' => 3
        // ]);

        // delete data
        // DB::table('students')->where('id', 27)->delete();


        // // eloquent
        // // manggil data
        // $students = Student::all();
        // dd($students);

        // // insert data
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '0201022',
        //     'class_id' => 2
        // ]);

        // // update data
        // Student::find(28)->update([
        //     'name' => 'eloquent 2',
        //     'class_id' => 4
        // ]);

        // delete data
        // Student::find(28)->delete();
        // Student::delete(); // hapus semua

        // raw query
        // insert data
        // insert into students ('name', 'gender', 'nis', 'class_id') values('raw query', 'P', '0201023', '3')

        // $nilai = [9, 8, 7, 6, 4, 8, 9, 1, 10, 3, 9, 7, 1, 5, 3, 9];
        
        // php biasa
        // 1. Hitung jumlah nilai
        // 2. Hitung berapa banyak nilai
        // 3. Hitung nilai rata-rata
        // $totalNilai = array_sum($nilai);
        // $countNilai = count($nilai);
        // $nilaiRataRata = $totalNilai / $countNilai;
        // dd($nilaiRataRata);

        // COLLECTION
        // 1. Hitung rata-rata nilai
        // $nilaiRataRata2 = collect($nilai)->avg();
        // dd($nilaiRataRata2);

        // contains = cek apakah sebuah array memiliki sesuatu, mengembalikan true atau false
        // $docontain = collect($nilai)->contains(10);
        // $docontain = collect($nilai)->contains(function($value){
        //     return $value < 6;
        // });

        // dd($docontain);

        // diff = bandingin isi array/collection, balikin value collection original yang gak ada di collection yang dikasih
        // $restaurantA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizza", "fried chicken", "martabak","sayur asem","pecel lele", "bakso"];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // $menuRestoB = collect($restaurantB)->diff($restaurantA);

        // dd($menuRestoB);

        // filter = 
        // $testfilter = collect($nilai)->filter(function ($value){
        //     return $value > 7;
        // })->all();

        // dd($testfilter);

        // $biodata = [
        //     ['nama' => 'budi', 'umur' => 17],
        //     ['nama' => 'ani', 'umur' => 16],
        //     ['nama' => 'siti', 'umur' => 17],
        //     ['nama' => 'rudi', 'umur' => 20],
        // ];

        // $testpluck = collect($biodata)->pluck('nama')->all();
        // dd($testpluck);

        // kita akan mencari hasil dari isi $nilai dikali 2
        // $nilaiKaliDua = [];
        // foreach ($nilai as $value){
        //     array_push($nilaiKaliDua, $value * 2);
        // }
        // dd($nilaiKaliDua);

        // $nilaiKaliDuaCol = collect($nilai)->map(function($value){
        //     return $value *2;   
        // })->all();
        // dd($nilaiKaliDuaCol);
    }
}