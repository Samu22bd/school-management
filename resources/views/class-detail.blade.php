@extends('layouts.mainlts')

@section('title', 'Class Detail')

@section('content')

<h1> Ini halaman Class Detail</h1>
<h2> Anda sedang melihat data detail dari kelas {{$clDetail->name}}</h2>

<div class="mt-5">
    <h4>Homeroom Teacher : {{$clDetail->ClassToTeacher->name}}</h4>
</div>

<div class="mt-5">
    <h4>List Students</h4>
    <ol>
        @foreach ($clDetail->ClassToStudents as $c)
            <li>{{$c->name}}</li>
        @endforeach
    </ol>
</div>

{{$clDetail}}

@endsection
