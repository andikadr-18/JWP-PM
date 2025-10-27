@extends('layout')

@section ('content')
    <h1>Edit Perpustakaan</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perpustakaan.update', $perpustakaan->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label>Image</label>
        <input 
            type="file" 
            name="image" 
            id="image" 
            class="form-control @error('image') is-invalid @enderror">

        <label>Title</label>
        <input 
            type="text"
            name="title"
            id="title"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title')}}">

        <label for="title" class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="">--STATUS--</option>
            <option value="TERSEDIA">TERSEDIA</option>
            <option value="DIPINJAM">DIPINJAM</option>
        </select>
    </form>
@endsection