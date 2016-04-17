@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="row equal">
	@foreach($template->lists as $list)
	<div class="col-lg-4 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
			{{$list->name}}
			</div>
			<div class="panel-body">
                
					<ul id="list_{{$list->id}}" class="list-group task-list">
<!-- 					    <li id="item-1" class="list-group-item">Item 1</li>
					    <li id="item-2" class="list-group-item">Item 2</li>
					    <li id="item-3" class="list-group-item">Item 3</li>
					    <li id="item-4" class="list-group-item">Item 4</li> -->
					@foreach($list->tasks as $task)

						<li id="item-{{$task->id}}" class="list-group-item"><div class="input-group"><span id="display_{{$task->id}}" class="display">{{$task->name}}</span><input type="text" id="edit_{{$task->id}}" class="edit form-control" style="display:none" /><span class="input-group-addon save" style="display:none"><i class="fa fa-save icon" id="save_{{$task->id}}" style="display:none"></i></span></div></li>
					@endforeach
					</ul>
					<div class="input-group">
					{!! Form::text('addtask',null,['id' => 'input_'.$list->id,'placeholder' => 'Add Task','class' => 'form-control']) !!} 
					<!-- <button type="submit" class="btn btn-primary btn-outline btn-xs "> -->
						<span class="input-group-addon"><i class="fa fa-plus plus addTask" id="add_{{$list->id}}"></i></span>
					<!-- </button> -->
					</div>
				
            </div>			
		</div>
	</div>
	@endforeach
	<a href="{{ route('admin.project_templates.task_lists.create',['id' => $template->id])}}" data-toggle="modal" data-target="#myModal">
	<div class="col-lg-4 col-md-6">
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
	        if($(this).children("li").length > 1){
            	$.ajax({
	                headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
	                data: data,
	                type: 'POST',
	                url: '/admin/project_templates/{{$template->id}}/task_lists/'+taskList+'/reorder'
	                // success: function(data){
	                // 	alert(JSON.stringify(data));
	                // }
	            });
            }
	
	}
    });
    //Edit Task
    //Convert To Input
    $(".display").click(function(){
  		$(this).hide();
  		$(this).siblings(".edit").show().val($(this).text()).focus();
  		var save = $(this).siblings('.save');
  		save.show();
  		save.children().show();
  		// $(this).siblings('.save').children('icon').show();
	});
	//Save & Update
	$(".edit").focusout(function(){
		$(this).hide();  
		$(this).siblings('.save').hide();
		$(this).siblings(".display").show().text($(this).val());
	});


    //Add Task
    $('.addTask').click(function(){
    	var taskList = $(this).attr('id');
    	var taskList = taskList.substring(taskList.indexOf("_") + 1);
    	var task = $('#input_'+taskList).val();
    	if(task != ''){
    		$.ajax({
	            headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        data: 'task='+task,
		        dataType: 'json',
		        type: 'POST',
		        url: '/admin/project_templates/{{$template->id}}/task_lists/'+taskList+'/tasks',
		        success: function(data){
		        	// alert(JSON.stringify(data));
		        	$('#list_'+taskList).append('<li class="list-group-item" id="5">'+task+'</li>');
		        	$('#input_'+taskList).val('');
		        }

	    	});    		
    	}
	
    });

});	
</script>
@stop