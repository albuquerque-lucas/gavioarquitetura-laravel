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

    public function editImage(Request $request)
    {
        $profile = Profile::find($request->id);

        Storage::disk('public')->delete($profile->img_path);
        $img = $request->file('img_path_profile')->store('users', 'public');
        $profile->img_path = $img;
        $profile->save();

        return redirect()->back();
    }
}
