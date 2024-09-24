<!-- alamat sesuaikan posisi file layout yang ingin digunakan -->
@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Home')

@section('content')

<h1> Ini halaman Class </h1>

<div class="my-5">
    <a href="" class="btn btn-primary">Add Data</a>
</div>

<h3>Class List</h3>
<table class="table">
    <thead>
        <tr>
            <th>No. </th>
            <th>Name. </th>
            <th>Action </th>
        </tr>
    </thead>

    <tbody>
        @foreach ($classList as $cl)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$cl->name}}</td>
            <td><a href="class/{{$cl->id}}">detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- phase 2 --}}

{{-- 
<table class="table">
    <thead>
        <tr>
            <th>No. </th>
            <th>Name. </th>
            <th>Students</th>
            <th>Homeroom Teacher</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($classList as $cl)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$cl->name}}</td>
            <td>
                @foreach($cl->ClassToStudents as $student)
                    {{$loop->iteration}}. {{$student->name}} 
                    <br>
                @endforeach
            </td>
            <td>{{$cl->ClassToTeacher->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table> 
--}}

@endsection