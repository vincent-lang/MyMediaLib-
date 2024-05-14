<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Request $request, $info = null)
    {
        if ($request != null) {
            $info = $request->input('search-value');
        }
        if ($info == null) {
            $photos = Photo::all();
            return view('user_story_05.index', compact('photos'));
        } else {
            $photos = Photo::where('data', 'like', $info . '%')->get();
            if ($photos->isEmpty()) {
                $photos = Photo::where('description', 'like', $info . '%')->get();
                return view('user_story_05.index')->with(['photos' => $photos]);
            }
            return view('user_story_05.index')->with(['photos' => $photos]);
        }
    }

    public function delete(Photo $photo)
    {
        $photo->delete();
        return redirect(route('photo.index'));
    }
}
