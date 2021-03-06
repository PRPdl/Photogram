@extends('layouts.app')

@section('content')
    <div class="container">
<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $channels as $ch)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $ch->name }}</td>
            <td>{{$ch->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
@endsection
