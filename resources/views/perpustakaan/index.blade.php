@extends('layout')

@section ('content')
    <h1>Perpustakaan</h1>
    <a href="{{ route('perpustakaan.create')}}">Create New Activity</a>

    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perpustakaan as $perpustakaan)
                <tr>
                    <td> {{$perpustakaan->id}} </td>
                    <td>
                @if ($perpustakaan->image)
                    <img src="{{ asset('storage/images/' . $perpustakaan->image) }}" alt="image"
                    style="max-width: 150px; max-height: 150px;"/>
                @else
                    No Image
                @endif

                </td>
                    <td> {{$perpustakaan->title}} </td>
                    <td> {{$perpustakaan->status}}</td>
                    <td>
                        <a href="{{ route ('perpustakaan.show', $perpustakaan->id)}}">Show</a>
                        <a href="{{ route ('perpustakaan.edit', $perpustakaan->id)}}">Edit</a>

                        <form action="{{ route('perpustakaan.destroy', $perpustakaan->id)}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection