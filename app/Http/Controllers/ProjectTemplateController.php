<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ProjectTemplate;

class ProjectTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_templates = ProjectTemplate::all();
        return view('admin.project_template_index',['title' => 'Project Templates','project_templates' => $project_templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.edit_project_template',['title' => 'Create a New Project Template']);
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
        $project_template = ProjectTemplate::create([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
        return redirect()->route('admin.project_templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectTemplate $template)
    {
        //
        return view('admin.project_templates.show_project',['title' => $template->name . ' - Project Template' ,'template' => $template]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectTemplate $template)
    {
        //
        return view('admin.edit_project_template',['title' => 'Edit Project Template: ' . $template->name,'template' => $template]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectTemplate $template, Request $request)
    {
        //
        $template->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
        return redirect()->route('admin.project_templates.index');
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
