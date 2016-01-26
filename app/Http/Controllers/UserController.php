<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\UserType;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contacts.create');
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
        $contact->types()->attach([1]);
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
        $contact = User::find($id);  
        return view('contacts.show',['title' => $contact->fullname, 'contact' => $contact]);
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
