@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Delete Student Page')

@section('content')

<div class="mt-5">
    <h2>Are you sure you want to delete the data of Student : {{$studentData->name}} {{$studentData->nis}}</h2>

    <form style="display: inline-block" action="/student-destroy/{{$studentData->id}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger"> Delete </button>
    </form>

    <a href="/students" class="btn btn-primary"> Cancel </a>
</div>

{{$studentData}}

@endsection