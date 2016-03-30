@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
@if($schedules)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Contact</th>
                <th>Scheduled Date</th>
                <th>Email Template</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
 		@foreach($schedules as $s)
            <tr>
                <td><a href="{{ route('contacts.show',[$s->contact->id])}}">{{ $s->contact->fullname }}</a> </td>
                <td>{{ $s->scheduled_date->format('n/d/Y') }} ({{ $s->scheduled_date->diffForHumans() }}) </td>
                <td>{{ $s->detail->template }}</td>
                <td><a href="{{ route('admin.response_schedules.delete',[$s]) }}" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@stop