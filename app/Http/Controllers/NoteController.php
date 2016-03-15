<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;
use App\Note;
use Carbon\Carbon;

class NoteController extends Controller
{
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
    public function create(Contact $contact)
    {
        //
        return view('contacts.notes.edit',['contact' => $contact]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Contact $contact, Request $request)
    {
        //
        $note = Note::create($request->except('note_date'));
        $note->note_date = Carbon::parse($request->input('note_date'));
        $note->user_id = $contact->id;
        $note->create_user_id = \Auth::user()->id;
        $note->save();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact,$id)
    {
        $note = Note::find($id);
        return view('contacts.notes.edit',['contact' => $contact,'note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Contact $contact, Request $request, $id)
    {
        //
        $note = Note::find($id);
        $note->update($request->except('note_date'));
        $note->note_date = Carbon::parse($request->input('note_date'));
        $note->save();
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
