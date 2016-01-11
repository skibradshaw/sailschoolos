
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

		
	</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Add Contact</button>
</div>
{!! Form::close() !!}
