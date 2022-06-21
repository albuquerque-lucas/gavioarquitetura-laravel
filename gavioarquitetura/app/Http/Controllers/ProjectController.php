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
        $projetos = Project::query()->orderBy('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('admin.index', compact('projetos', 'mensagem', 'categories', 'name'));

    }

    public function categoryIndex(Request $request)
    {
        $id = $request->id;
        $nome = $request->nome;
        $projetos = Project::query()->where('categoria_id', $id)->get();
        $categorias = Category::query()->orderBy('id')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('admin.index', compact('projetos', 'categorias', 'mensagem', 'nome'));
    }


    public function create()
    {
        $categorias = Category::query()->orderBy('id')->get();
        return view('admin.create', compact('categorias'));
    }

    public function store(ProjectFormRequest $request, ProjectCreator $projectCreator)
    {

        $image = $projectCreator->coverUpload($request);
        $projeto = $projectCreator->createProject($request->name, $request->area, $request->year, $request->address, $request->description, $image, $request->categoryId, $request->carousel);

        $request->session()->flash('mensagem', "Projeto $project {$projeto->nome} adicionado com sucesso.");
        return redirect()->route('admin_projetos.index');

    }

    public function destroy(Request $request, ProjectRemover $projectRemover)
    {

        $projectName = $projectRemover->removeProject($request->id);
        $request->session()->flash('mensagem', "O projeto $projectName foi removido com sucesso.");
        return redirect()->back();

    }

    public function editaCampoNome(Request $request)
    {
        $novoNome = $request->nome;
        $project = Project::find($request->id);
        $project->nome = $novoNome;
        $project->save();
    }

    public function editaCampoArea(Request $request)
    {
        $novaArea = $request->area;
        $project = Project::find($request->id);
        $project->area = $novaArea;
        $project->save();
    }

    public function editaCampoAno(Request $request)
    {
        $novoAno = $request->ano;
        $project = Project::find($request->id);
        $project->ano = $novoAno;
        $project->save();
    }

    public function editaCampoLocalizacao(Request $request)
    {
        $novaLocalizacao = $request->localizacao;
        $project = Project::find($request->id);
        $project->localizacao = $novaLocalizacao;
        $project->save();
    }

    public function editaCampoDescricao(Request $request)
    {
        $novaDescricao = $request->descricao;
        $project = Project::find($request->id);
        $project->descricao = $novaDescricao;
        $project->save();
    }

    public function editaImagemCapa(Request $request)
    {

        $project = Project::find($request->id);


        Storage::delete($project->img_path);
        $img = $request->file('img_path-edit')->store('projeto-capa');
        $project->img_path = $img;
        $project->save();

        return redirect()->back();
    }


    public function show(int $projectId)
    {
        $project = Project::find($projectId);
        $idProjeto = $project->id;
        $images = Image::query()->orderBy('id')->where('project$projectId_id', $projectId)->get();

        return view('admin-individual.index', compact('project', 'images', 'idProjeto'));
    }

    public function individualFotosStore(Request $request)
    {
        $idProjeto = $request->id;
        $project = Project::find($idProjeto);
        $fotos = [];
        $fileRequest = $request->file('fotos');

        foreach ($fileRequest as $file){

            $nome = time().rand(1, 100). '.' . $file->extension();
            $file->move(storage_path('app/public/colecao-fotos'), $nome);
            $project->fotos()->create(['photo_path' =>  $nome, 'projeto_id' => $idProjeto]);

        }

        return redirect()->back();
    }

    public function individualFotosDestroy(Request $request, ImageRemover $removedorDeFotos)
    {
        $removedorDeFotos->destroyImages($request->id);
        return redirect()->back();
    }
}
