@extends('layouts.mainlts')

@section('title', 'Extracurricular Detail')

@section('content')

<h1>Ini halaman Extracurricular</h1>

<div class="my-5">
    <a href="" class="btn btn-primary">Add Data</a>
</div>

<h3>Extracurricular List</h3>

<table class="table">
    <thead>
        <tr>
            <th>No. </th>
            <th>Name. </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exlist as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td><a href="extracurricular-detail/{{$data->id}}">detail</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- p2 --}}
{{-- <table class="table">
    <thead>
        <tr>
            <th>No. </th>
            <th>Name. </th>
            <th>Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exlist as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td>
                    @foreach($data->ExtracurricularToStudent as $d)
                    - 
                    {{$d->name}} 
                    <br>
                    @endforeach
                </td>
                <td>{{$data->ExtracurricularToStudent}}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

@endsection