<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\UserController;
use App\User;
use App\Inquiry;
use Carbon\Carbon;
use Log;


class InquiryController extends Controller
{
    private $user;

    public function __construct(UserController $user)
    {
        $this->middleware('auth',['except' => ['storeWeb']]);
        $this->user = $user;
    }

    public function index()
    {
        $inquiries = Inquiry::orderBy('created_at','desc')->get();
        return view('contacts.inquiries_index',['title' => 'Inquiries','inquiries' => $inquiries]);
    }

    public function create()
    {
        $interests = [
            'Sailing School' => 'Sailing School',
            'Boat Charter' => 'Boat Charter',
            'Buying a Boat' => 'Buying a Boat',
            'Selling a Boat' => 'Selling a Boat'
        ];
        return view('contacts.inquiry',['title' => 'Create Sailing School Inquriy','interests' => $interests]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        //return implode(", ",$input['interests']);
        $user = User::where('email',$input['email'])->first();
        if(!$user)
        {
            $this->user->store($request);
            $user = User::where('email',$input['email'])->first();
        }
        //@TODO: Use this form to capture inquiries for Charters, Boat Buying and Selling
        $input['user_id'] = $user->id;
        
        $interests = implode(", ",$input['interests']);
        $inquiry = Inquiry::create([
            'user_id' => $input['user_id'],
            'type' => $input['type'],
            'destination' => $input['destination'],
            'boat_type' => $input['boat_type'],
            'interests' => $interests,
            'notes' => $input['notes']
        ]);
        return redirect()->route('inquiries');   
    }

    public function storeWeb(Request $request)
    {
        //Process Gravity Form Fields to match Database
        $input = $request->all();
        $input['type'] = 'Sailing School';
        (!empty($input['destination_grenada'])) ? $input['destination'] = 'Grenada' : $input['destination'] = '';
        (!empty($input['destination_stvincent'])) ? $input['destination'] .= ' St. Vincent' : $input['destination'];
        (!empty($input['boat_monohull'])) ? $input['boat_type'] = 'Monohull' : $input['boat_type'] = '';
        (!empty($input['boat_catamaran'])) ? $input['boat_type'] .= ' Monohull' : $input['boat_type'];

        Log::info($input);
        // $user = User::where('email',$input['email'])->first();
        // if(!$user)
        // {
        //     $this->user->store($request);
        //     $user = User::where('email',$input['email'])->first();
        // }
        // //@TODO: Use this form to capture inquiries for Charters, Boat Buying and Selling
        // $input['user_id'] = $user->id;
        
        // $interests = implode(", ",$input['interests']);
        // $inquiry = Inquiry::create([
        //     'user_id' => $input['user_id'],
        //     'type' => $input['type'],
        //     'destination' => $input['destination'],
        //     'boat_type' => $input['boat_type'],
        //     'interests' => $interests,
        //     'notes' => $input['notes']
        // ]); 

        //Mail::raw('Test Booking',function($message){$message->to('tim@alltrips.com'); $message->from('info@ltdsailing.com');});
        return $request->all();

    }

    public function show($id)
    {
        $inquiry = Inquiry::find($id);
        $user = User::find($inquiry->user_id);
        return view('contacts.inquiry_show',['title' => $inquiry->type . " Inquiry"]);
    }
}
