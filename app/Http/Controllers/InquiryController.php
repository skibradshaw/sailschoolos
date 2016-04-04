<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\ScheduleResponse;

use App\Http\Controllers\UserController;
use App\User;
use App\Inquiry;
use App\ResponseSchedule;
use Carbon\Carbon;
use Log;

class InquiryController extends Controller
{
    private $user;

    public function __construct(UserController $user)
    {
        $this->middleware('auth', ['except' => ['storeWeb']]);
        $this->user = $user;
    }

    public function index()
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        return view('contacts.inquiries_index', ['title' => 'Inquiries','inquiries' => $inquiries]);
    }

    public function create()
    {
        $interests = [
            'Sailing School' => 'Sailing School',
            'Boat Charter' => 'Boat Charter',
            'Buying a Boat' => 'Buying a Boat',
            'Selling a Boat' => 'Selling a Boat'
        ];
        return view('contacts.inquiry', ['title' => 'Create Sailing School Inquriy','interests' => $interests]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // return $request->all();
        //return implode(", ",$input['interests']);
        $user = User::where('email', $input['email'])->first();
        if (!$user) {
            $this->user->store($request);
            $user = User::where('email', $input['email'])->first();
        }
        if (!$user->types()->where('user_types.id', 1)->first()) {
            $user->types()->attach([1]);
        }
        //@TODO: Use this form to capture inquiries for Charters, Boat Buying and Selling
        $input['user_id'] = $user->id;
        
        $interests = implode(", ", $input['interests']);
        $inquiry = Inquiry::create([
            'user_id' => $input['user_id'],
            'type' => $input['type'],
            'destination' => $input['destination'],
            'boat_type' => $input['boat_type'],
            'interests' => $interests,
            'notes' => $input['notes']
        ]);
        //Create a Note
        $note = $user->notes()->create([
            'note_date' => Carbon::now(),
            'title' => 'Manual Inquiry',
            'note_type' => 'Inquiry',
            'create_user_id' => \Auth::user()->id,
            'note' => $input['notes']
            ]);

        //Schedule Initial Inquiry Response for 37 Minutes after Inquiry
        $this->scheduleInitialResponse($user);

        // Fire Scheduled Responses
        \Event::fire(new ScheduleResponse($inquiry));
        return redirect()->route('inquiries');
    }

    public function storeWeb(Request $request)
    {
        //Process Gravity Form Fields to match Database
        $input = $request->all();
        $input['type'] = 'Sailing School';
        (!empty($input['dest_grenada'])) ? $input['destination'] = 'Grenada' : $input['destination'] = '';
        (!empty($input['dest_stvincent'])) ? $input['destination'] .= ' St. Vincent' : $input['destination'];
        (!empty($input['boat_monohull'])) ? $input['boat_type'] = 'Monohull' : $input['boat_type'] = '';
        (!empty($input['boat_catamaran'])) ? $input['boat_type'] .= ' Catamaran' : $input['boat_type'];
        (!empty($input['newsletter'])) ? $input['newsletter'] = 1 : $input['newsletter'] = 0;

        Log::info($input);
        $user = User::where('email', $input['email'])->first();
        if (!$user) {
            $this->user->store($request);
            $user = User::where('email', $input['email'])->first();
        }
        if (!$user->types()->where('user_types.id', 1)->first()) {
            $user->types()->attach([1]);
        }
        //@TODO: Use this form to capture inquiries for Charters, Boat Buying and Selling
        $input['user_id'] = $user->id;
        
        
        $inquiry = Inquiry::create([
            'user_id' => $input['user_id'],
            'type' => $input['type'],
            'destination' => $input['destination'],
            'boat_type' => $input['boat_type'],
            'notes' => $input['notes']
        ]);
        //Create a Note
        $note = $user->notes()->create([
            'note_date' => Carbon::now(),
            'title' => 'Website Inquiry',
            'note_type' => 'Inquiry',
            'create_user_id' => User::where('email', 'chris@ltdsailing.com')->first()->id,
            'note' => $input['notes']
            ]);

        //Schedule Initial Inquiry Response for 37 Minutes after Inquiry
        $this->scheduleInitialResponse($user);

        //Fire Prospect Inquiry Scheduled Responses.
        \Event::fire(new ScheduleResponse($inquiry));
        //Mail::raw('Test Booking',function($message){$message->to('tim@alltrips.com'); $message->from('info@ltdsailing.com');});
        return $request->all();

    }
    public function scheduleInitialResponse(User $user)
    {
        //Schedule Initial Inquiry Response for 37 Minutes after Inquiry
        $schedule = ResponseSchedule::create([
                'user_id' => $user->id,
                'response_template_detail_id' => 0,
                'most_recent_note_id' => 0,
                'scheduled_date' => Carbon::now()->addMinutes(37),
                'status' => 'active'
            ]);
        return $schedule;
    }
    public function show($id)
    {
        $inquiry = Inquiry::find($id);
        $user = User::find($inquiry->user_id);
        return view('contacts.inquiry_show', ['title' => $inquiry->type . " Inquiry"]);
    }
}
