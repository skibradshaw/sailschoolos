@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
	{!! Form::model($contact,['route' => ['contacts.update',$contact->id],'method' => 'Put']) !!}
	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
			  	{!! Form::label('fullname','Name',['for' => 'fullname']) !!}
			  	{!! Form::text('fullname',null,['id' => 'fullname', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
			  	{!! Form::label('email','Email',['for' => 'email']) !!}
			  	{!! Form::email('email',null,['id' => 'email', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
			  	{!! Form::label('phone','Phone',['for' => 'phone']) !!}
			  	{!! Form::text('phone',null,['id' => 'phone', 'class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			  	{!! Form::label('city','City',['for' => 'city']) !!}
			  	{!! Form::text('city',null,['id' => 'city', 'class' => 'form-control']) !!}
			</div>	
			<div class="form-group">
			  	{!! Form::label('state','State',['for' => 'state']) !!}
			  	{!! Form::select('state',$states,$contact->state,['id' => 'state', 'class' => 'form-control']) !!}
			</div>	

			<div class="form-group">
			  	{!! Form::label('country','Country',['for' => 'country']) !!}
			  	{!! Form::select('country',$countries,$contact->country, ['id' => 'country', 'class' => 'form-control']) !!}
			</div>					
		</div>
	</div>

	{!! Form::close() !!}


@stop