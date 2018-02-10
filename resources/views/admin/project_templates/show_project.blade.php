@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="row" style="margin-bottom: 20px">
	<div class="col-sm-12 col-lg-12">
		<a href="{{ route('admin.project_templates.task_lists.create',['id' => $template->id])}}" data-toggle="modal" data-target="#myModal" class="btn btn-outline btn-primary">Create a New List</a>		
	</div>
</div>


<div class="row">
	@foreach($template->lists as $list)
	<div class="col-lg-4 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-9 col-lg-9 text-left">
						<span class="panel-title">{{$list->name}}</span>				
					</div>
					<div class="col-xs-3 col-lg-3 text-right">
						<a href="{{route('admin.project_templates.task_lists.destroy',['template' => $template,'taskList' => $list->id])}}" class="btn btn-primary btn-xs deleteTaskList" id="delete_{{$list->id}}" name="{{$list->name}}"><i class="fa fa-times"></i></a>
					</div>
				</div>
			</div>
			<div class="panel-body">
                
					<ul id="list_{{$list->id}}" class="list-group task-list">
<!-- 					    <li id="item-1" class="list-group-item">Item 1</li>
					    <li id="item-2" class="list-group-item">Item 2</li>
					    <li id="item-3" class="list-group-item">Item 3</li>
					    <li id="item-4" class="list-group-item">Item 4</li> -->
					@foreach($list->tasks as $task)

						<li id="item-{{$task->id}}" class="list-group-item"><span id="display_{{$task->id}}" class="display">{{$task->name}}</span><div class="input-group edit" style="display:none" id="form_{{$task->id}}"><span class="input-group-addon btn btn-danger btn-outline btn-xs deleteTask" id="deleteTask_{{$task->id}}"><i class="fa fa-trash icon"></i></span><input type="text" id="edit_{{$task->id}}" class="form-control edit" /><span class="input-group-addon save btn btn-primary btn-outline btn-xs"  id="save_{{$task->id}}"><i class="fa fa-save icon"></i></span></div></li>
					@endforeach
					</ul>
					<div class="input-group">
					{!! Form::text('addtask',null,['id' => 'input_'.$list->id,'placeholder' => 'Add Task','class' => 'form-control']) !!} 
					<!-- <button type="submit" class="btn btn-primary btn-outline btn-xs "> -->
						<span class="input-group-addon btn btn-primary btn-xs addTask" id="add_{{$list->id}}" data-loading-text="<i class='icon-spinner icon-spin icon-large'></i>" ><i class="fa fa-plus plus"></i></span>
					<!-- </button> -->
					</div>
				
            </div>			
		</div>
	</div>
	@endforeach
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

    //Delete Task List
   $('.deleteTaskList').click(function(event){
	    event.preventDefault();
	    var taskList = $(this).attr('id');
	    var name = $(this).attr('name');
	    taskList = taskList.substring(taskList.indexOf("_") + 1);
	    var r=confirm("Are you sure you want to delete the "+name);
	    if (r==true)   {  
	       window.location = $(this).attr('href');
	    }
   });

//Edit Task - http://jsbin.com/ijexak/2/edit?html,css,js,output
    //Convert To Input
    $(document).on("click",".display",function(){
  		var task = $(this).attr('id');
  		task = task.substring(task.indexOf("_") + 1);
  		$('#display_'+task).hide();
  		$('#display_'+task).siblings(".edit").show();
  		$('#edit_'+task).val($(this).text()).focus();
	});
	//Save & Update
	$(document).on('click',".save",function(){
  		var taskId = $(this).attr('id');
  		taskId = taskId.substring(taskId.indexOf("_") + 1);
  		task = $('#edit_'+taskId).val();
  		taskList = $('#item-'+taskId).closest('ul').attr('id');
  		taskList = taskList.substring(taskList.indexOf("_") + 1);
  		$.ajax({
    		headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: 'name='+task+'&id='+taskId,
	        dataType: 'json',
	        type: 'PATCH',
	        url: '/admin/project_templates/{{$template->id}}/task_lists/'+taskList+'/tasks/'+taskId,
	        success: function(data){
				$('#form_'+taskId).hide();  
				$('#display_'+taskId).show().text(data['name']);	        	
	        }
  		});
	});
	//Cancel Edit Task
	$(document).on('focusout',".edit",function(){
  		var taskId = $(this).attr('id');
  		taskId = taskId.substring(taskId.indexOf("_") + 1);
		$('#form_'+taskId).hide();  
		$('#display_'+taskId).show().text($('#edit_'+taskId).val());
	});

//End Edit a Task


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
		        	// alert(JSON.stringify(data['id']));
		        	$('#list_'+taskList).append('<li id="item-'+data['id']+'" class="list-group-item"><span id="display_'+data['id']+'" class="display">'+task+'</span><div class="input-group edit" style="display:none" id="form_'+data['id']+'"><span class="input-group-addon btn btn-danger btn-outline btn-xs deleteTask" id="deleteTask_'+data['id']+'"><i class="fa fa-trash icon"></i></span><input type="text" id="edit_'+data['id']+'" class="form-control edit" /><span class="input-group-addon save btn btn-primary btn-outline btn-xs"  id="save_'+data['id']+'"><i class="fa fa-save icon"></i></span></div></li>');
		        	$('#input_'+taskList).val('');
		        }

	    	});    		
    	}
	
    });

    //Delete Task
    $(document).on('click','.deleteTask',function(){
  		var taskId = $(this).attr('id');
  		taskId = taskId.substring(taskId.indexOf("_") + 1);
   		var taskList = $('#item-'+taskId).closest('ul').attr('id');
  		taskList = taskList.substring(taskList.indexOf("_") + 1); 		
		// alert(taskList);	
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: 'taskid='+taskId,
			dataType: 'json',
			type: 'DELETE',
			url: '/admin/project_templates/{{$template->id}}/task_lists/'+taskList+'/tasks/'+taskId,
			success: function(data){
				// alert(data);
				$('#item-'+taskId).remove();
			}
		});  		
    });

});	
</script>
@stop