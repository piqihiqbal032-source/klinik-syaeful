@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold">{{ $dokter->nama_dokter }}</h1>
    <p>Ini adalah halaman detail jadwal dokter.</p>
</div>
@endsection