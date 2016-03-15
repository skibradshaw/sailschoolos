
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Add a Note</h4>

</div>
	@if(isset($note))
	{!! Form::model($note,['route' => ['contacts.notes.update',$contact->id,$note->id],'method' => 'put']) !!}
	@else
	{!! Form::open(['route' => ['contacts.notes.store','contact' => $contact->id]]) !!}
	@endif
<div class="modal-body">
	<div class="te">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-12">
			  	{!! Form::label('note_date','Date of Communication',['for' => 'note_date']) !!}
			  	</div>
			</div>
			<div class="row">
			  	<div class="col-sm-3">
			  	{!! Form::text('note_date',(isset($note->note_date)) ? $note->note_date->format('n/d/Y') : \Carbon\Carbon::now()->format('n/d/Y') ,['id' => 'note_date', 'class' => 'form-control']) !!}
			  	</div>
			</div>
		</div>
		<div class="form-group">
		  	{!! Form::label('title','Title',['for' => 'title']) !!}
		  	{!! Form::text('title',null,['id' => 'title', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('note_type','Type:',['for' => 'note_type']) !!}
		  	{!! Form::select('note_type',['Email' => 'Email','Phone' => 'Phone','In-Person' => 'In-Person'],null,['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Choose...']) !!}
		</div>
		<div class="form-group">
		  	{!! Form::label('note','Note',['for' => 'note']) !!}
		  	{!! Form::textarea('note',null,['id' => 'note', 'class' => 'form-control']) !!}
		</div>		
	</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" id="add_contact">Save Note</button>
</div>
{!! Form::close() !!}

  <script>
  $(function() {
    $( "#note_date" ).datepicker();
  
  });


  </script>
