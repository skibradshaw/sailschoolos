@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<a href="{{ route('admin.project_templates.create') }}" class="btn btn-outline btn-primary">Create a New Category</a>
@if ($project_templates)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th># of Lists</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
 		@foreach($project_templates as $template)
            <tr>
                <td><a href="{{ route('admin.project_templates.show',[$template->id]) }}">{{ $template->name }}</td>
                <td>{{ $template->description }}</td>
                <td>{{ $template->lists()->count('id') }}</td>
                <td><a href="{{ route('admin.project_templates.edit',[$template->id]) }}" class="btn btn-primary btn-sm">Edit</a></td>
                <!-- <td><a href="{{ route('admin.project_templates.task_lists.create',['id' => $template->id])}} " class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add List</a></td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endif
@stop