<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProjectTemplate;
use App\ProjectTemplateTaskList;
use App\ProjectTemplateTask;

class ProjectTemplateTaskController extends Controller
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
    public function create()
    {
        //
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTemplate $template, $id, Request $request)
    {
        $taskList = ProjectTemplateTaskList::find($id);
        $position = $taskList->tasks->max('position')+1;
        $task = $taskList->tasks()->create([
                'name' => $request->input('task'),
                'position' => $position
            ]);
        return $task;
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
    public function update(ProjectTemplate $template, $taskListId, $taskId, Request $request)
    {
        $task = ProjectTemplateTask::find($taskId);
        if($task){
            $task->update(['name' => $request->input('name')]);
        }
        
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTemplate $template, $taskListId, $taskId)
    {
        ProjectTemplateTask::destroy($taskId);
        return $template;
    }
}
