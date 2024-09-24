@extends('layouts.mainlts')

@section('title', 'Student Detail')


@section('content')

<h1> Ini halaman Student Detail</h1>
<h2> Anda sedang melihat data detail dari siswa {{$studentDetail->name}}</h2>

<div class="my-3 d-flex justify-content-center">
    @if ($studentDetail->image != '')
        <img src=" {{asset('storage/photo/'.$studentDetail->image)}}" alt="" width="200px">
    @else
        <img src=" {{asset('images/OIP.jpg')}}" alt="" width="200px">
    @endif
</div>

<div class="mt-5 mb-5">
    <table class="table table-bordered">
        <tr>
            <td>NIS</td>
            <td>Gender</td>
            <td>Class</td>
            <td>Homeroom Teacher</td>
        </tr>
        <tr>
            <td>{{$studentDetail->nis}}</td>
            {{-- <td>{{$studentDetail->gender}}</td> --}}
            <td>
                @if ($studentDetail->gender == 'P')
                    Perempuan
                @else
                    Laki-Laki
                @endif
            </td>
            <td>{{$studentDetail->StudentToClass->name}}</td>
            <td>{{$studentDetail->StudentToClass->ClassToTeacher->name}}</td>
        </tr>
    </table>
</div>

<div>
    <h3>Extracurriculars</h3>
    <ol>
        @foreach ($studentDetail->StudentToExtracurricular as $s)
            <li> {{$s->name}} </li>
        @endforeach
    </ol>
</div>

<style>
    td{
        width: 25%
    }
</style>

{{-- {{$studentDetail}}
{{$studentDetail->StudentToClass}}
{{$studentDetail->StudentToClass->ClassToTeacher}} --}}



@endsection
