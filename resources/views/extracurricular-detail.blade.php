@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Home')

@section('content')

<h2>Anda sedang melihat data detail Extracurricular {{$exDetail->name}}</h2>

<div class="mt-5">
    <h3>List Peserta</h3>
    <ol>
        @foreach ($exDetail->ExtracurricularToStudent as $e)
            <li>{{$e->name}}</li>
        @endforeach
    </ol>
</div>

{{$exDetail}}

@endsection
