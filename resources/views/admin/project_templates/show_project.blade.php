@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="row equal">
	@foreach($template->lists as $list)
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
			{{$list->name}}
			</div>
			<div class="panel-body">
                <i class="fa fa-plus"></i> <a href="#">Add Task</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>			
		</div>
	</div>
	@endforeach
	<a href="{{ route('admin.project_templates.task_lists.create',['id' => $template->id])}}" data-toggle="modal" data-target="#myModal">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-body" style="min-height: 200px">
				<div class="row">
                    <div class="col-xs-3 text-center">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-left">
						<span class="huge">New</span>
                    </div>				
				</div>
			</div>
		</div>
	</div>
	</a>
</div>
@stop