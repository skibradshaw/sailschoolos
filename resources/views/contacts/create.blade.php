
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Quick Add Contact</h4>

</div>
{!! Form::open(['route' => 'contacts.store']) !!}
<div class="modal-body">
	<div class="te">
		<div class="form-group">
		  	{!! Form::label('name','Name',['for' => 'name']) !!}
		  	{!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('email','Email',['for' => 'email']) !!}
		  	{!! Form::email('email',null,['id' => 'email', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('phone','Phone',['for' => 'phone']) !!}
		  	{!! Form::text('phone',null,['id' => 'phone', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('types_list','Contact Types',['for' => 'types_list']) !!}
		  	{!! Form::select('types_list[]',$types,null,['id' => 'types_list', 'class' => 'form-control','multiple']) !!}
		</div>
		
	</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" disabled id="add_contact">Add Contact</button>
</div>
{!! Form::close() !!}
<script type="text/javascript">
$( document ).ready(function() {
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    $('#name').keyup(function() {

        var empty = false;
        if ($(this).val().length == 0) {
            empty = true;
        }

        if (empty) {
            $('#add_contact').attr('disabled', 'disabled');
        } else {
            $('#add_contact').removeAttr('disabled');
        }
    });	

    $('#types_list').select2();
    
});	


</script>