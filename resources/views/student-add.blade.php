@extends('layouts.mainlts')

@section('title', 'Add New Student')

@section('content')

<div class="mt-5 col-8 m-auto">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- untuk upload image tambahkan enctype="multipart/form-data" --}}
    <form action="student" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            {{-- class dibawah bawaan bootstrap --}}
            {{-- <input type="text" class="form-control" name="name" id="name" required> --}}
            {{-- ga perlu required karena sudah di controller --}}
            <input type="text" class="form-control" name="name" id="name">
        </div>

        <div class="mb-3">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">Select One</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nis">NIS</label>
            <input type="text" class="form-control" name="nis" id="nis">
        </div>

        <div class="mb-3">
            <label for="class">Class</label>
            <select name="class_id" id="class" class="form-control">
                <option value="">Select One</option>
                @foreach ($classList as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="photo">Photo</label>
            <div class="input-group">
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>

    </form>

</div>

@endsection