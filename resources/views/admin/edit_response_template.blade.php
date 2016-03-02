@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
@if(isset($template))
	{!! Form::model($template,['route' => ['admin.response_templates.update','id' => $template->id],'role' => 'form','method' => 'PUT']) !!}
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
				{!! Form::label('trigger_event', 'Trigger Event', ['for' => 'trigger_event']) !!}
				{!! Form::select('trigger_event',$triggers,null,['id' => 'trigger_event','placeholder' => 'Choose...', 'class' => 'form-control']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">Schedule Details</div>
				<div class="panel-body">
					<div class="row">
						<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="details">
							<thead>
								<tr>
									<th width="150px">Days after Trigger</th>
									<th>Email Template Name</th>
									<th width="75px">Remove</th>
								</tr>
								<tr></tr>
							</thead>
							<tbody>
							@if(isset($template))
								@foreach($template->details as $detail)
								<tr>
									<td width="150px">{!! Form::text('days[]',$detail->number_of_days,['id' => 'days','class' => 'form-control']) !!}</td>
									<td>{!! Form::select('template[]',['Welcome Template' => 'Welcome Template','Second Followup Template' => 'Second Followup Template'],$detail->template,['id' => 'template','class' => 'form-control']) !!}</td>
									<td width="75px"><i class="fa fa-remove fa-fw del"></i></td>
								</tr>
								@endforeach
							@else
								<tr>
									<td width="150px">{!! Form::text('days[]',null,['id' => 'days','class' => 'form-control']) !!}</td>
									<td>{!! Form::select('template[]',['Welcome Template' => 'Welcome Template','Second Followup Template' => 'Second Followup Template'],'Welcome Template',['id' => 'template','class' => 'form-control']) !!}</td>
									<td width="75px"><i class="fa fa-remove fa-fw del"></i></td>
								</tr>
								<tr>
									<td width="150px">{!! Form::text('days[]',null,['id' => 'days','class' => 'form-control']) !!}</td>
									<td>{!! Form::select('template[]',['Welcome Template' => 'Welcome Template','Second Followup Template' => 'Second Followup Template'],'Welcome Template',['id' => 'template','class' => 'form-control']) !!}</td>
									<td width="75px"><i class="fa fa-remove fa-fw del"></i></td>
								</tr>
							@endif
							</tbody>
						</table>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<a href="#" id="add">Add a Line Item</a>
						</div>
					</div>
				</div>
			</div>		
		</div>

	</div>
	<div class="row">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">Save This Schedule</button> or <a href="{{ URL::previous() }}">Go Back ></a>
			<p></p>
		</div>
	</div>




	{!! Form::close() !!}
@stop
@section('scripts')
<script type="text/javascript">
    //Add Line Items
    $(document).ready(function() {
        $("#add").click(function() {
          $('#details tbody>tr:last').clone(true).insertAfter('#details tbody>tr:last');
          return false;
        });
    });

    //Remove Line Items
   $(".del").click(function(){
	   		$(this).closest('table#details tbody>tr:not(:first-child)').remove();
   });
</script>
@stop