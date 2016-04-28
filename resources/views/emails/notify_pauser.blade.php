{{$pauser->firstname}},
You paused the scheduled responses for {{$schedule->contact->fullname}} three days ago and there have been no communication notes since then.  Do you want to reactivate these scheduled responses?

If you want to reactivate these responses, click here: {{ route('contacts.show',['id' => $schedule->contact->id]) }}

Thanks!  We don't want to forget anyone...