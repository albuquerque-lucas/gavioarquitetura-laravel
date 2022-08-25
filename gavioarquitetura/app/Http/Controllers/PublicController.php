<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function index()
    {
        $title = "Gávio Arquitetura";
        $projects = Project::query()->where('activate_carousel', true)->get();

        return view('public.index', compact('projects', 'title'));
    }

    public function projectsByCategory(Request $request)
    {
        $title = "Nossos Projetos | Gávio Arquitetura";
        $id = $request->id;
        $name = $request->name;
        $projects = Project::query()->where('category_id', $id)->orderByDesc('id')->get();
        $categories = Category::query()->orderBy('id')->get();
        return view('public.projects', compact('projects', 'categories', 'name', 'title'));
    }

    public function profile(Request $request)
    {
        $title = "Quem Somos | Gávio Arquitetura";
        $profiles = Profile::all();

        return view('public.about-us', compact('profiles', 'title'));
    }

    public function show(int $project_id)
    {
        $project = Project::find($project_id);
        $title = $project->name . ' | Gávio Arquitetura';
        $images = Image::query()->orderBy('id')->where('project_id', $project_id)->get();

        return view('public.show', compact('project', 'images', 'title'));
    }

    public function email()
    {
        $title = "Contato | Gávio Arquitetura";
        return view('public.mail', compact('title'));
    }
}
