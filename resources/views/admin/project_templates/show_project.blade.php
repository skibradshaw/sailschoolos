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
                
					<ul id="{{$list->id}}" class="list-group task-list">
					    <li id="item-1" class="list-group-item">Item 1</li>
					    <li id="item-2" class="list-group-item">Item 2</li>
					    <li id="item-3" class="list-group-item">Item 3</li>
					    <li id="item-4" class="list-group-item">Item 4</li>
					</ul>
					{!! Form::text('addtask',null,['id' => 'input_'.$list->id,'placeholder' => 'Add Task']) !!} <i class="fa fa-plus fa-1x plus" id="add_{{$list->id}}"></i> 
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
@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
    
	//Order Task List
    $('ul.task-list').sortable({
        axis: 'y',
        stop: function (event, ui) {
	        var taskList = $(this).attr('id');
	        var data = $(this).sortable('serialize');
            // $('span').text(data);
            $.ajax({
                headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
                data: data,
                type: 'POST',
                url: '/admin/project_templates/{{$template->id}}/task_lists/'+taskList+'/reorder',
                success: function(data){
                	alert(JSON.stringify(data));
                }
            });
	}
    });
});	
</script>
@stop