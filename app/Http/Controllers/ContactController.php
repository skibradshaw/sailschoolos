<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseScheduleController;

use App\Contact;
use App\User;
use App\UserType;


class ContactController extends Controller
{
    private $schedules;

    public function __construct(ResponseScheduleController $schedules)
    {
        $this->schedules = $schedules;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::all();
        return view('contacts.index',['title' => 'All Contacts','contacts' => $contacts]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $types = UserType::lists('name','id');
        return view('contacts.create',['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $parts = explode(" ", $input['name']);
        $input['lastname'] = array_pop($parts);
        $input['firstname'] = implode(" ", $parts);    
        (empty($input['firstname'])) ? ($input['firstname'] = $input['lastname']) && ($input['lastname'] = '') : $input['firstname'];
        unset($input['name']);
        $contact = User::create($input);
        if(!empty($input['types_list']))
        {
            $contact->types()->attach($input['types_list']);            
        }

        return redirect()->route('contacts.show',['id' => $contact->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //
        $contact = Contact::find($id);
        // return $contact;
        $schedules = $this->schedules->contact($contact); //Gets any Scheduled Responses for the contact grouped by Template  
        $template_ids = '0,';
        foreach($schedules as $s)
        {
            $template_ids .= $s->template->id . ',';
        }
        $template_ids = rtrim($template_ids,',');
        if($schedules)
        {
            $response_templates = \App\ResponseTemplate::whereRaw('id IN ('. $template_ids .')')->get();        
        }
        // $schedules = new \App\ResponseSchedule;
        // $response_templates = new \App\ResponseTemplate;
        return view('contacts.show',['title' => $contact->fullname, 'contact' => $contact, 'schedules' => $schedules,'response_templates' => $response_templates]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $countries = \CountryState::getCountries();
        $states = \CountryState::getStates('US');
        $contact = User::find($id);
        $types = UserType::lists('name','id');
        (empty($contact->country)) ? $contact->country = 'US' : $contact->country;
        return view('contacts.edit',['
            title' => 'Edit Contact: ' . $contact->fullname,
            'contact' => $contact,
            'states' => $states,
            'countries' => $countries,
            'types' => $types
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //TODO: Add Validation
        $contact = User::find($id);
        $contact->update($request->all());
        $contact->types()->sync($request->input('types_list'));
        return redirect()->route('contacts.show',['id' => $contact->id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
