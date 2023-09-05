@extends('layouts.main')

@section('container')
<h1>Halaman About</h1>
<!-- <h3><?= $name ?></h3>
    <h3><?= $email ?></h3>
    <h3><?= $jurusan ?></h3> -->
<!-- blade version -->
<h3>{{$name}}</h3>
<h3>{{$email}}</h3>
<h3>{{$jurusan}}</h3>
@endsection