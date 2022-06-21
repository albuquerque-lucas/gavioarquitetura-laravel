<?php

namespace App\Http\Controllers;

use App\Models\Project;
use http\Exception\RuntimeException;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $idProjeto = $request->id;
        $projeto = Project::find($idProjeto);
        $fotos = [];
        $fileRequest = $request->file('fotos');

        foreach ($fileRequest as $file){
            $nome = time().rand(1, 100). '.' . $file->extension();
            $file->move(storage_path('app/public/colecao-fotos'), $nome);
            $projeto->fotos()->create(['photo_path' => $nome, 'projeto_id' => $idProjeto]);

        }

        return redirect()->back();
    }
}
