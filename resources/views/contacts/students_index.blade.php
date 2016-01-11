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
 		@foreach($students as $student)
            <tr>
                <td>{{ $student->id }} </td>
                <td><a href="{{ route('contacts.edit',[$student->id]) }}">{{ $student->fullname }}</a></td>
                <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->city }}, {{ $student->state }}</td>
                <td>{{ $student->country }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop