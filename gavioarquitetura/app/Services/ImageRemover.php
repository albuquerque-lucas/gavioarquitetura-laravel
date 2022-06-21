<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageRemover
{
    public function destroyImages(int $fotoId) : string
    {
        $nomeFoto = '';
        DB::transaction(function() use ($fotoId, &$nomeFoto){
            $foto = Image::find($fotoId);
            $nomeFoto = $foto->photo_path;
            $foto->delete();

            if($foto->photo_path)
            {
                unlink(storage_path('app/public/colecao-fotos/' . $nomeFoto));
            }


        });
        return $nomeFoto;
    }
}
