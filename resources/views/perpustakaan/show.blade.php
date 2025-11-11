@extends('layout')

@section('content')
    <img src="{{ asset('storage/images/' . $perpustakaan->image) }}" alt="image"
                    style="max-width: 150px; max-height: 150px;"/>
    <h1>{{ $perpustakaan->title}}</h1>
    <p>{{ $perpustakaan->status}}</p>
    <a href="{{ route ('perpustakaan.index')}}">Back</a>
@endsection