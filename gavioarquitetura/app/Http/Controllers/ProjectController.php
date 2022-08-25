<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Models\Image;
use App\Models\Category;
use App\Models\Project;
use App\Http\Requests\ProjectFormRequest;
use App\Services\ProjectHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(Autenticador::class);
    }

    public function index(Request $request)
    {
        $name = 'Projetos';
        $projects = Project::query()->orderByDesc('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        $message = $request->session()->get('message');
        return view('admin.index', compact('projects', 'message', 'categories', 'name'));

    }

    public function categoryIndex(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $projects = Project::query()->where('category_id', $id)->orderByDesc('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        $message = $request->session()->get('mensagem');
        return view('admin.index', compact('projects', 'categories', 'message', 'name'));
    }


    public function create()
    {
        $categories = Category::query()->orderBy('id')->get();
        return view('admin.create', compact('categories'));
    }

    public function store(ProjectFormRequest $request, ProjectHandler $projectCreator)
    {

        $image = $projectCreator->uploadCover($request, 'img_path');
        $project = $projectCreator->createProject(
            $request->name,
            $request->area,
            $request->year,
            $request->address,
            $request->description,
            $image,
            $request->category_id,
            $request->activate_carousel);

        $request->session()->flash('message', "Projeto $project->name adicionado com sucesso.");
        return redirect('/admin-projects/'.$project->id);

    }

    public function destroy(Request $request, ProjectHandler $projectHandler)
    {

        $projectName = $projectHandler->removeProject($request->id);
        $request->session()->flash('mensagem', "O projeto $projectName foi removido com sucesso.");
        return redirect()->back();

    }

    public function show(int $project_id)
    {
        $project = Project::find($project_id);
        $images = Image::query()->orderBy('id')->where('project_id', $project_id)->get();
        return view('admin.show', compact('project', 'images'));
    }

    public function editName(Request $request)
    {
        $newName = $request->name;
        $project = Project::find($request->id);
        $project->name = $newName;
        $project->save();
    }

    public function editArea(Request $request)
    {
        $newArea = $request->area;
        $project = Project::find($request->id);
        $project->area = $newArea;
        $project->save();
    }

    public function editYear(Request $request)
    {
        $newDate = $request->year;
        $project = Project::find($request->id);
        $project->year = $newDate;
        $project->save();
    }

    public function editAddress(Request $request)
    {
        $newAddress = $request->address;
        $project = Project::find($request->id);
        $project->address = $newAddress;
        $project->save();
    }

    public function editDescription(Request $request)
    {
        $newDescription = $request->description;
        $project = Project::find($request->id);
        $project->description = $newDescription;
        $project->save();
    }

    public function editCover(Request $request, ProjectHandler $projectHandler)
    {

        $project = Project::find($request->id);
        $projectHandler->removeOldCover($project);
        $projectHandler->uploadCover($request, 'img_path-edit');

        Storage::delete($project->img_path);

        $img = $request->file('img_path-edit')->store('project-cover');
        $project->img_path = $img;
        $project->save();

        return redirect()->back();
    }


}
