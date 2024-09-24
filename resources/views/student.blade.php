<!-- alamat sesuaikan posisi file layout yang ingin digunakan -->
@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Home')

@section('content')

<h1> Ini halaman Student </h1>

<div class="my-5 d-flex justify-content-between">
    <a href="student-add" class="btn btn-primary">Add Data</a>
    <a href="student-deleted" class="btn btn-info">Show Deleted Data</a>
</div>

@if (Session::has('status'))
    <div class="alert alert-success" role="alert">
        {{Session::get('message')}}
    </div>
@else   
    
@endif

<h3>Student List</h3>

<div class="my-3 col-12 col-sm-8 col-md-6">
    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="Nama?">
            <button class="input-group-text btn btn-primary">Search</button>
        </div>
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Gender</th>
            <th>NIS</th>
            <th>Class</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentList as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->gender}}</td>
                <td>{{$data->nis}}</td>
                <td>{{$data->StudentToClass->name}}</td>
                <td>
                    @if(Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                        -
                    @else
                        <a href="student/{{$data->id}}">detail</a>
                        <a href="student-edit/{{$data->id}}">edit</a>
                    @endif

                    @if(Auth::user()->role_id == 1)
                        <a href="student-delete/{{$data->id}}">delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="my-5">
    {{-- {{$studentList->links()}} --}}
    {{-- tambahin withQueryString jika ttp mau simpen keyword --}}
    {{$studentList->withQueryString()->links()}}
</div>

{{-- phase 2 below --}}
{{-- bisa juga manggil menggunakan array, ga panah --}}
{{-- <td>{{$data->StudentToClass}}</td> --}}
{{-- <td>{{$data->StudentToClass->ClassToTeacher}}</td> --}}

{{-- <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Gender</th>
            <th>NIS</th>
            <th>class id</th>
            <th>class</th>
            <th>Extracurriculars</th>
            <th>Homeroom Teacher</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentList as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->gender}}</td>
                <td>{{$data->nis}}</td>
                <td>{{$data->class_id}}</td>
                
                <td>{{$data['StudentToClass']['name']}}</td>
                <td>
                    @foreach ($data->StudentToExtracurricular as $d)
                        {{$d->name}}
                    @endforeach
                </td>
                <td>{{$data->StudentToClass->ClassToTeacher->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

{{-- <ol>
    @foreach ($studentList as $data)
    <li>
        {{$data->name}} | {{$data->gender}} | {{$data->nis}}
    </li>
    @endforeach
</ol> --}}

@endsection
