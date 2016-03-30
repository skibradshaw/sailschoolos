@extends('app')
@section('header')
<h1 class="page-header">{{ $title or 'Sail School OS' }}</h1>
@stop
@section('content')
<div class="row">
	<div class="col-sm-8">
		<div class="panel panel-default">
	        <div class="panel-heading">
	           <i class="fa fa-user fa-fw"></i> Vitals <a href="{{ route('contacts.edit',[$contact->id]) }}" class="btn btn-primary btn-xs pull-right">Edit</a>
	        </div>
	        <!-- /.panel-heading -->
	        <div class="panel-body">
				<address>
				  <strong>Phone: {{ $contact->phone }}</strong><br>
				  Email: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
				</address>
	        </div>
		</div>
	</div>
	<div class="col-sm-4">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-check fa-fw"></i> Tasks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        </div>
                        <!-- /.panel-body -->
                    </div>		
	</div>
</div>
<div class="row">
	<div class="col-lg-8">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <i class="fa fa-clock-o fa-fw"></i> Communication History <a href="{{ route('contacts.notes.create',[$contact])}} " class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal">Add Note</a>
	        </div>
	        <!-- /.panel-heading -->
	        <div class="panel-body">
	            <ul class="timeline">
	            @forelse($contact->notes as $i => $n)
	                <li{{ $i % 2 == 0 ? null : " class=timeline-inverted"}}>
	                    <div class="timeline-badge {{$n->badge}}">{!!$n->icon!!}
	                    </div>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">{{$n->title}}</h4>
	                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{$n->note_date->diffForHumans() }} by {{$n->creator->fullname}}</small>
	                            </p>
	                        </div>
	                        <div class="timeline-body">
	                            <p>{!! $n->note !!}</p>
	                            <p class="text-right"><small class="text-muted"><a href="{{ route('contacts.notes.edit',['contact' => $contact->id,'note' => $n->id]) }}"  data-toggle="modal" data-target="#myModal">Edit</a></small></p>
	                        </div>
	                    </div>
	                </li>
	            @empty
	            	<li>No History</li>
	            @endforelse
<!-- 	                <li class="timeline-inverted">
	                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
	                    </div>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
	                        </div>
	                    </div>
	                </li>
	                <li>
	                    <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
	                    </div>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
	                        </div>
	                    </div>
	                </li>
	                <li class="timeline-inverted">
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
	                        </div>
	                    </div>
	                </li>
	                <li>
	                    <div class="timeline-badge info"><i class="fa fa-save"></i>
	                    </div>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
	                            <hr>
	                            <div class="btn-group">
	                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
	                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
	                                </button>
	                                <ul class="dropdown-menu" role="menu">
	                                    <li><a href="#">Action</a>
	                                    </li>
	                                    <li><a href="#">Another action</a>
	                                    </li>
	                                    <li><a href="#">Something else here</a>
	                                    </li>
	                                    <li class="divider"></li>
	                                    <li><a href="#">Separated link</a>
	                                    </li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </li>
	                <li>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
	                        </div>
	                    </div>
	                </li>
	                <li class="timeline-inverted">
	                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
	                    </div>
	                    <div class="timeline-panel">
	                        <div class="timeline-heading">
	                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
	                        </div>
	                        <div class="timeline-body">
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
	                        </div>
	                    </div>
	                </li> -->
	            </ul>
	        </div>
	        <!-- /.panel-body -->
	    </div>	
	</div>
	<div class="col-sm-4">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Scheduled Responses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	@forelse($response_templates as $t)
                        		<h5>{{$t->name}}</h5>
	                        	<ul class="list-unstyled">
	                        	
	                        	@forelse($schedules->filter(function($schedules) use ($t){if($schedules->template->id == $t->id) return true;}) as $s)
	                        		@if(!is_null($s->sent_date))
	                        		<del><li><i class="fa fa-check fa-fw"></i> {{ $s->scheduled_date->format('n/d/y') }} - {{ $s->detail->template }}</li></del>
	                        		@else
	                        		<li><i class="fa fa-calendar fa-fw"></i> {{ $s->scheduled_date->format('n/d/y') }} - {{ $s->detail->template }}</li>
	                        		@endif
	                        	@empty
	                        		<li>None</li>
	                        	@endforelse
	                        	</ul>
	                        @empty
	                        	<h5>No Responses Scheduled</h5>
	                        @endforelse
                        </div>
                        <!-- /.panel-body -->
                    </div>			
	</div>
</div>



@stop