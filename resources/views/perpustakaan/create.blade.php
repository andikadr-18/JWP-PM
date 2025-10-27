@extends('layout')

@section ('content')
    <h1>Create Perpustakaan</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perpustakaan.store', $perpustakaan->id)}}" method="POST">
        @csrf

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
            value="{{ old('title)}}"
            placeholder="Tolong Isi Judul Buku">

        <label for="title" class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="">--STATUS--</option>
            <option value="TERSEDIA">TERSEDIA</option>
            <option value="DIPINJAM">DIPINJAM</option>
        </select>
            <button type="submit">Submit</button>
    </form>
@endsection