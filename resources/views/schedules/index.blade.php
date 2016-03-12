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
                
            </tr>
        </thead>
        <tbody>
 		@foreach($schedules as $s)
            <tr>
                <td>{{ $s->contact->fullname }} </td>
                <td>{{ $s->scheduled_date->format('n/d/Y') }} ({{ $s->scheduled_date->diffForHumans() }}) </td>
                <td>{{ $s->detail->template }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@stop