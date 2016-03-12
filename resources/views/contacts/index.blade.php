@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
 		@foreach($contacts as $c)
            <tr>
                <td>{{ $c->id }} </td>
                <td><a href="{{ route('contacts.show',[$c->id]) }}">{{ $c->fullname }}</a></td>
                <td><a href="mailto:{{ $c->email }}">{{ $c->email }}</a></td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->city }}, {{ $c->state }}</td>
                <td>{{ $c->country }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop