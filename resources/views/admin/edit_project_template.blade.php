@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
@if (isset($project_template))
{!! Form::model($project_template,['route' => ['admin.project_templates.update','id' => $project_template->id],'role' => 'form','method' => 'PUT']) !!}
@else
{!! Form::open(['route' => 'admin.project_templates.store','role' => 'form']) !!}
@endif
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
				{!! Form::label('name','Project Template Name: ',['for' => 'name']) !!}
				{!! Form::text('name',null,['id' => 'name']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('description','This template is for...',['for' => 'description']) !!}
				{!! Form::textarea('description',null,['id' => 'description','rows' => 4, 'cols' => 50]) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">Save This Template</button> or <a href="{{ URL::previous() }}">Go Back ></a>
			<p></p>
		</div>
	</div>
{!! Form::close() !!}
@stop