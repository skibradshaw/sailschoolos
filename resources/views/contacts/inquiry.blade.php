
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">{{ $title }}</h4>

</div>
{!! Form::open(['route' => 'inquiry.store']) !!}
{!! Form::hidden('type','Sailing School') !!}
<div class="modal-body">
	<div class="te">
		<div class="form-group">
		  	{!! Form::label('name','Name',['for' => 'name']) !!}
		  	{!! Form::text('name',null,['id' => 'name', 'class' => 'form-control req']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('email','Email',['for' => 'email']) !!}
		  	{!! Form::email('email',null,['id' => 'email', 'class' => 'form-control req']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('phone','Phone',['for' => 'phone']) !!}
		  	{!! Form::text('phone',null,['id' => 'phone', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('destination','Destination',['for' => 'destination']) !!}
		  	{!! Form::select('destination',['Grenadines' => 'Grenadines','St Vincent' => 'St Vincent'],['id' => 'destination', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('boat_type','Boat Preference',['for' => 'boat_type']) !!}
		  	{!! Form::select('boat_type',['Catamaran' => 'Catamaran','Monohull' => 'Monohull'],['id' => 'boat_type', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('interests','Interested In: ',['for' => 'interests']) !!}
		  	{!! Form::select('interests[]',$interests,"Sailing School",['id' => 'interests', 'class' => 'form-control', 'multiple']) !!}
		</div>				
		<div class="form-group">
		  	{!! Form::label('notes','Notes',['for' => 'notes']) !!}
		  	{!! Form::textarea('notes',null,['id' => 'notes', 'class' => 'form-control']) !!}
		</div>
	</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" disabled id="add_inquiry">Add Inquiry</button>
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
            $('#add_inquiry').attr('disabled', 'disabled');
        } else {
            $('#add_inquiry').removeAttr('disabled');
        }
    });	

    $('#interests').select2();
    
});	


</script>