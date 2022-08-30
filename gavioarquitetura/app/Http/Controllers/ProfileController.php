<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\ProjectFormRequest;
use App\Models\Profile;
use App\Services\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(Autenticador::class);
    }

    public function index()
    {
        $profiles = Profile::query()->orderBy('id')->get();
        return view('profiles.index', compact('profiles'));
    }

    public function editName(Request $request)
    {
        $newName = $request->name;
        $profile = Profile::find($request->id);
        $profile->name = $newName;
        $profile->save();
    }

    public function editDescription(Request $request)
    {
        $newDescription = $request->description;
        $profile = Profile::find($request->id);
        $profile->description = $newDescription;
        $profile->save();
    }

    public function editImage(Request $request, ImageHandler $imageHandler)
    {
        $profile = Profile::find($request->id);
        $imageHandler->uploadProfileImage($profile, $request);

        return redirect()->back();
    }
}
