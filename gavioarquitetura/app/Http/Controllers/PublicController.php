<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function index(Request $request)
    {
        $title = "Gávio Arquitetura";
        $projects = Project::query()->where('carrossel', true)->get();

        return view('public.index', compact('projects', 'title'));
    }

    public function categoryIndex(Request $request)
    {
        $title = "Nossos Projetos | Gávio Arquitetura";
        $id = $request->id;
        $nome = $request->nome;
        $projects = Project::query()->where('categoria_id', $id)->get();
        $categories = Category::query()->orderBy('id')->get();
        return view('public.projects', compact('projects', 'categories', 'nome', 'title'));
    }

    public function profile(Request $request)
    {
        $title = "Quem Somos | Gávio Arquitetura";
        $profiles = Profile::all();

        return view('public.about-us', compact('profiles', 'title'));
    }

    public function projects()
    {
        $nome = 'Projetos';
        $title = "Nossos Projetos | Gávio Arquitetura";
        $projects = Project::query()->orderBy('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        return view('public.projects', compact('title', 'projects', 'categories', 'nome'));
    }

    public function show(int $idProject)
    {
        $project = Project::find($idProject);
        $title = $project->nome . ' | Gávio Arquitetura';
        $images = Image::query()->orderBy('id')->where('projeto_id', $idProject)->get();

        return view('public.show', compact('project', 'images', 'title'));
    }

    public function email()
    {
        $title = "Contato | Gávio Arquitetura";
        return view('public.mail', compact('title'));
    }
}
