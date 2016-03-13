@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Name</th>
                <th>Email</th>
                <th>Destination</th>
                <th>Boat Type</th>
                <th>Notes</th>
                <th>Interested in...</th>
            </tr>
        </thead>
        <tbody>
 		@foreach($inquiries as $inquiry)
            @if($inquiry->processed == 1)
            <tr class="success">
            @else
            <tr>
            @endif
                <td>{{ $inquiry->created_at->format('n/d/Y') }} </td>
                <td nowrap="nowrap">{{ $inquiry->type }}</td>
                <td nowrap="nowrap"><a href="{{ route('contacts.show',[$inquiry->user_id])}}">{{ $inquiry->user->fullname }}</a></td>
                <td><a href="mailto:{{ $inquiry->user->email }}">{{ $inquiry->user->email }}</a></td>
                <td>{{ $inquiry->destination }}</td>
                <td>{{ $inquiry->boat_type }}</td>
                <td>{{ $inquiry->notes }}</td>
                <td>{{ $inquiry->interests }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop