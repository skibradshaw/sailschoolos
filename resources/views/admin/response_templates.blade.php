@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<a href="{{ route('admin.response_templates.create')}}" class="btn btn-primary">Create a Response Template</a>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Type</th>
                <th>Trigger Event</th>
                <th># of Responses</th>
            </tr>
        </thead>
        <tbody>
 		@foreach($templates as $template)
            <tr>
                <td><a href="{{ route('admin.response_templates.edit',[$template->id]) }}">{{ $template->name }}</td>
                <td>{{ $template->type->name }}</td>
                <td>{{ $template->trigger_event }}</td>
                <td>{{ $template->details()->count('id') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop