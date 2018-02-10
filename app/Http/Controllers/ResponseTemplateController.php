<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\UserType;
use \App\ResponseTemplate;
use \App\ResponseTemplateDetail;

class ResponseTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $templates = ResponseTemplate::all();
        return view('admin.response_templates', ['title' => 'Automated Response Templates','templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usertypes = UserType::all()->pluck('name', 'id');
        $triggers = [1 => 'Prospect Inquiry', 2 => 'Class Registration'];
        return view('admin.edit_response_template', [
            'title' => 'Create Response Templates',
            'usertypes' => $usertypes,
            'triggers' => $triggers
            ]);
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
        // return $request->all();
        $template = ResponseTemplate::create($request->only('name', 'trigger_event', 'user_type_id'));
        $inputTemplate = $request->input('template');
        $inputSubject = $request->input('subject');
        foreach ($request->input('days') as $key => $detail) {
            $templatedetail = new ResponseTemplateDetail;
            $templatedetail->number_of_days = $detail;
            $templatedetail->template = $inputTemplate[$key];
            $templatedetail->subject = $inputSubject[$key];
            $template->details()->save($templatedetail);
        }
        return redirect()->route('admin.response_templates.index');
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
    public function edit($id)
    {
        //
        $template = ResponseTemplate::find($id);
        $usertypes = UserType::all()->pluck('name', 'id');
        $triggers = [1 => 'Prospect Inquiry', 2 => 'Class Registration'];
        return view('admin.edit_response_template', [
            'title' => 'Create Response Templates',
            'usertypes' => $usertypes,
            'triggers' => $triggers,
            'template' => $template
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
        // return $request->all()
        $template = ResponseTemplate::find($id);
        $template->update($request->only('name', 'trigger_event', 'user_type_id'));
        $inputTemplate = $request->input('template');
        $inputSubject = $request->input('subject');
        $inputDetail = $request->input('detail_id');
        foreach ($request->input('days') as $key => $detail) {
            //Check if it exists and update
            $templatedetail = ResponseTemplateDetail::find($inputDetail[$key]);
            $templatedetail->number_of_days = $detail;
            $templatedetail->template = $inputTemplate[$key];
            $templatedetail->subject = $inputSubject[$key];
            $template->details()->save($templatedetail);
        }
        return redirect()->route('admin.response_templates.index');
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
