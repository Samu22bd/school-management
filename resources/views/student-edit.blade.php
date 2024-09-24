@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Home')

@section('content')

<div class="mt-5 col-8 m-auto">
    {{-- form ga support put, patch, delete, jadi kita pakai method bawaan --}}
    <form action="/student/{{$student->id}}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$student->name}}" required>
        </div>

        <div class="mb-3">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="{{$student->gender}}">{{$student->gender}}</option>
                @if ($student->gender == 'P')
                    <option value="L">L</option>
                @else
                    <option value="P">P</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="nis">NIS</label>
            <input type="text" class="form-control" name="nis" id="nis" value="{{$student->nis}}" required>
        </div>

        <div class="mb-3">
            <label for="class">Class</label>
            <select name="class_id" id="class" class="form-control" required>
                <option value="{{$student->class_id}}">{{$student->StudentToClass->name}}</option>
                @foreach ($classList as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Update</button>
        </div>

    </form>

    {{$student}}
    <br> <br>
    {{$student->StudentToClass->name}}
    <br> <br>
    {{$classList}}


</div>


@endsection