<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(Autenticador::class);
    }

    public function index(Request $request)
    {
        $perfis = Profile::query()->orderBy('id')->get();
        return view('perfis.index', compact('perfis'));
    }

    public function editaNomeProfile(Request $request)
    {
        $novoNome = $request->nome;
        $profile = Profile::find($request->id);
        $profile->nome = $novoNome;
        $profile->save();
    }

    public function editaDescricaoProfile(Request $request)
    {
        $novaDescricao = $request->descricao;
        $profile = Profile::find($request->id);
        $profile->descricao = $novaDescricao;
        $profile->save();
    }

    public function editaImagemProfile(Request $request)
    {
        $profile = Profile::find($request->id);

        Storage::disk('public')->delete($profile->img_path);
        //Storage::delete($profile->img_path);
        $img = $request->file('img_path_profile')->store('users', 'public');
        $profile->img_path = $img;
        $profile->save();

        return redirect()->back();
    }
}
