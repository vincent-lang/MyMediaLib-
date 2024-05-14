<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {

        $photos = Photo::all();
        return view('user_story_05.index', compact('photos'));
    }

    public function delete(Photo $photo)
    {
        $photo->delete();
        return redirect(route('photo.index'));
    }
}
