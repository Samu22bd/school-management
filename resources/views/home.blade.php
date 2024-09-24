<!-- alamat sesuaikan posisi file layout yang ingin digunakan -->
@extends('layouts.mainlts')

<!-- mengirim variabel dengan nama 'title' berisikan data 'Home -->
@section('title', 'Home')

@section('content')

<h1> Ini halaman Home </h1>
<h2> Selamat datang, {{Auth::user()->name}}. Role anda adalah  {{Auth::user()->role->name}}.</h2>

{{Auth::user()}}

<!-- ada juga unless, isset, empty -->

{{-- <!-- @if ($role=='admin')
    <a href="">ke Halaman Admin</a>
@elseif ($role=='staff')
    <a href="">ke Halaman Gudang</a>
@else
    <a href="">ke Backrooms</a>
@endif -->

<!-- @switch($role)
    @case($role=='admin')
        <a href="">ke Halaman Admin</a>
        @break

    @case($role=='staff')
        <a href="">ke Halaman Gudang</a>
        @break

    @default
        <a href="">ke Backrooms</a>

    @endswitch -->

<!-- @for($i = 0; $i < 5; $i++)
    The current value is {{$i}} <br>
@endfor

@foreach ($buah as $b)
    {{ $b }} <br>
@endforeach -->

<table class='table'>
    <tr>
        <th>No.</th>
        <th>Nama</th>
    </tr>
    @foreach ($buah as $b)
        <tr>
            <!-- $loop ada di dokumentasi -->
            <td> {{$loop->iteration}} </td>
            <td> {{ $b }} </td>
        </tr>
    @endforeach
</table> --}}

@endsection