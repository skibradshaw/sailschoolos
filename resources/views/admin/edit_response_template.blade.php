@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
@if(isset($template))
	{!! Form::model($template,['route' => 'admin.response_templates.update',['id' => $template->id],'role' => 'form','method' => 'PUT']) !!}
@else
	{!! Form::open(['route' => 'admin.response_templates.store','role' => 'form']) !!}
@endif
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
				{!! Form::label('name','Response Schedule Name',['for' => 'name']) !!}
				{!! Form::text('name',null,['id' => 'name','class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('user_type_id', 'Contact Type',['for' => 'user_type_id']) !!}
				{!! Form::select('user_type_id', $usertypes, null, ['id' => 'user_type_id', 'placeholder' => 'Choose...', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('trigger', 'Trigger Event', ['for' => 'trigger']) !!}
				{!! Form::select('trigger',$triggers,null,['id' => 'trigger','placeholder' => 'Choose...', 'class' => 'form-control']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">Schedule Details</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-3">
							Days from Trigger
						</div>
						<div class="col-sm-8">
							Email Template Name
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								{!! Form::text('days',null,['id' => 'days','class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								{!! Form::select('template',['Welcome Template','Second Followup Template'],'Welcome Template',['id' => 'template','class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								{!! Form::text('days',null,['id' => 'days','class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								{!! Form::select('template',['Welcome Template','Second Followup Template'],'Welcome Template',['id' => 'template','class' => 'form-control']) !!}
							</div>
						</div>
					</div>				<div class="row">
						<div class="col-sm-12">
							<a href="#">Add a Line Item</a>
						</div>
					</div>
				</div>
			</div>		
		</div>

	</div>
	<div class="row">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">Save This Schedule</button>
			<p></p>
		</div>
	</div>




	{!! Form::close() !!}
@stop