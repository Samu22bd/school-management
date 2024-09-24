@extends('layouts.mainlts')

@section('title', 'teacher')

@section('content')

<h2>
    Anda sedang melihat data detail dari Teacher yang bernama {{$tDetail->name}}
</h2>

    <div class="mt-5">
        <h3>
            Class : 
            @if ($tDetail->TeacherToClass)
                {{$tDetail->TeacherToClass->name}}
            @else
                <p>tes</p>
            @endif

        </h3>
    </div>


{{$tDetail}}

@endsection