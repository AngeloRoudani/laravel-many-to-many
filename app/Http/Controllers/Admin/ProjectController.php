<?php

namespace App\Http\Controllers\Admin ;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->all());
        $form_project = $request->validated();

        $newProject = new Project();
        $newProject->name = $form_project["name"];
        $newProject->framework = $form_project["framework"];
        $newProject->start_date = $form_project["start_date"];
        $newProject->type_id = $form_project["type_id"];
        $newProject->description = $form_project["description"];
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->save();

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        if ($request->hasFile('image')) {
            $img_path = Storage::put('file_img', $request->image);
            $form_project['image'] = $img_path;
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {   
        
        $update_project = $request->validated();
        $project->technologies()->sync($request->technologies);  
        
        if ($request->hasFile('image')) {

            if($project->image) {
                Storage::delete($project->image);
                $img_path = Storage::put('file_img', $request->image);
                $update_project['image'] = $img_path;
            }
        }
                                                                                                        
        $project->update($update_project);

        return redirect()->route('admin.projects.show', ['project'=> $project->slug]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

}
