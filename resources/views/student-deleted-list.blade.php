@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Delete Student Page')

@section('content')

<h2>Ini halaman Student yang sudah di delete</h2>

<div class="my-5">
    <a href="students" class="btn btn-primary">Back</a>
</div>

<div class="mt-5">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>NIS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $s)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->gender}}</td>
                    <td>{{$s->nis}}</td>
                    <td>
                        <a href="/student/{{$s->id}}/restore">Restore</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection