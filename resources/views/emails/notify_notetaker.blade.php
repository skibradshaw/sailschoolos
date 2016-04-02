{{$schedule->note->creator->firstname}},
Your note titled: '{{$schedule->note->title}}' has rescheduled a response to {{$schedule->contact->fullname}}.  The next response is scheduled for {{$schedule->scheduled_date->diffForHumans()}}.

If you want to pause future responses, click here: {{ route('contacts.show',['id' => $schedule->contact->id]) }}

"I just want to tell you both good luck!  We are all counting on you."
- Dr. Rumack, Airplane the Movie