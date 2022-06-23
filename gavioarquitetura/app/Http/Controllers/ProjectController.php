<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Models\Image;
use App\Models\Category;
use App\Models\Project;
use App\Http\Requests\ProjectFormRequest;
use App\Services\ProjectCreator;
use App\Services\ImageRemover;
use App\Services\ProjectRemover;
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
        $projects = Project::query()->orderBy('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        $message = $request->session()->get('message');
        return view('admin.index', compact('projects', 'message', 'categories', 'name'));

    }

    public function categoryIndex(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $projects = Project::query()->where('category_id', $id)->get();
        $categories = Category::query()->orderBy('id')->get();
        $message = $request->session()->get('mensagem');
        return view('admin.index', compact('projects', 'categories', 'message', 'name'));
    }


    public function create()
    {
        $categories = Category::query()->orderBy('id')->get();
        return view('admin.create', compact('categories'));
    }

    public function store(ProjectFormRequest $request, ProjectCreator $projectCreator)
    {

        $image = $projectCreator->coverUpload($request);
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
        return redirect()->route('admin_projects.index');

    }

    public function destroy(Request $request, ProjectRemover $projectRemover)
    {

        $projectName = $projectRemover->removeProject($request->id);
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
        $novoNome = $request->nome;
        $project = Project::find($request->id);
        $project->nome = $novoNome;
        $project->save();
    }

    public function editArea(Request $request)
    {
        $novaArea = $request->area;
        $project = Project::find($request->id);
        $project->area = $novaArea;
        $project->save();
    }

    public function editYear(Request $request)
    {
        $novoAno = $request->ano;
        $project = Project::find($request->id);
        $project->ano = $novoAno;
        $project->save();
    }

    public function editAddress(Request $request)
    {
        $novaLocalizacao = $request->localizacao;
        $project = Project::find($request->id);
        $project->localizacao = $novaLocalizacao;
        $project->save();
    }

    public function editDescription(Request $request)
    {
        $novaDescricao = $request->descricao;
        $project = Project::find($request->id);
        $project->descricao = $novaDescricao;
        $project->save();
    }

    public function editCover(Request $request)
    {

        $project = Project::find($request->id);


        Storage::delete($project->img_path);
        $img = $request->file('img_path-edit')->store('projeto-capa');
        $project->img_path = $img;
        $project->save();

        return redirect()->back();
    }


}
