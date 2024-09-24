<!-- alamat sesuaikan posisi file layout yang ingin digunakan -->
@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'teacher')

@section('content')

    <h1>Ini Halaman Teacher</h1>

    <div class="my-5">
        <a href="" class="btn btn-primary">Add Data</a>
    </div>
    
    <h3>Teacher List</h3>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teacherList as $data)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <th>{{$data->name}}</th>
                    <th><a href="teacher-detail/{{$data->id}}">Detail</a></th>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection