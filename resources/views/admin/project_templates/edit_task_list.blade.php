
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Create a Task List - {{$template->name}}</h4>

</div>
{!! Form::open(['route' => ['admin.project_templates.task_lists.store','template' => $template]]) !!}
<div class="modal-body">
		<div class="form-group">
			{!! Form::label('name','Give this Task List a name: ') !!}
			{!! Form::text('name',null) !!}			
		</div>		
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" id="add_list">Create List</button>
</div>
<script type="text/javascript">
// $( document ).ready(function() {
//     $.fn.modal.Constructor.prototype.enforceFocus = function() {};
//     $('#name').keyup(function() {

//         var empty = false;
//         if ($(this).val().length == 0) {
//             empty = true;
//         }

//         if (empty) {
//             $('#add_contact').attr('disabled', 'disabled');
//         } else {
//             $('#add_contact').removeAttr('disabled');
//         }
//     });	

//     $('#types_list').select2();
    
// });	


</script>