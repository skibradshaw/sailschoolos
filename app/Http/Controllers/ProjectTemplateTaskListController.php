<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProjectTemplate;
use App\ProjectTemplateTaskList;
use App\ProjectTemplateTask;

class ProjectTemplateTaskListController extends Controller
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
    public function create(ProjectTemplate $template)
    {
        //
        return view('admin.project_templates.edit_task_list',['template' => $template]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTemplate $template, Request $request)
    {
        //
        $list = $template->lists()->create(['name' => $request->input('name')]);
        return redirect()->route('admin.project_templates.show',['template' => $template]);
        
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTemplate $template, $id)
    {
        //
        ProjectTemplateTaskList::destroy($id);
        return redirect()->back()->with('status','Task List Deleted!');
    }

    public function reorder(ProjectTemplate $template, $id, Request $request)
    {
        $taskList = ProjectTemplateTaskList::find($id);
        $i = 1;
        $return = '';
        foreach($request->input('item') as $task)
        {
            $return .= $task . " in Position ". $i . "; ";
            $task = ProjectTemplateTask::find($task);
            $task->position = $i;
            $task->save();
            $i++;
        }
        return $return;
    }
}
