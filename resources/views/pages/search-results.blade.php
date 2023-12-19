
@extends('layout.app')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    @if ($users->isEmpty())
        <p>No results found.</p>
    @else
        <ul>
            @foreach ($users as $user)
                <a href=""><li>Name: {{ $user->name }} - Email: {{ $user->email }}</li></a>
            @endforeach
        </ul>
    @endif
@endsection
