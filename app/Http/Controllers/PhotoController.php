<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    public function index(Request $request, $info = null)
    {
        //* checks if the user has put in a search value
        if ($request != null) {
            $info = $request->input('search-value');
        }
        //* if the info variable is empty then it shows all the records 
        if ($info == null) {
            $photos = DB::table('photos')->orderBy('id', 'desc')->get();
            return view('user_story_05.index', compact('photos'));
            //* otherwise it checks the name of a photo matching the search value
        } else {
            $photos = DB::table('photos')->where('data', 'like', $info . '%')->orderBy('id', 'desc')->get();
            //* checks if the database doesn't give photos and then it will look if the search value matches the description
            if ($photos->isEmpty()) {
                $photos = DB::table('photos')->where('description', 'like', $info . '%')->orderBy('id', 'desc')->get();
                return view('user_story_05.index')->with(['photos' => $photos]);
            }
            return view('user_story_05.index')->with(['photos' => $photos]);
        }
    }

    //* if this function gets called then it deletes the image that the user has selected to delete
    public function delete(Photo $photo)
    {
        //* deletes the image
        $photo->delete();
        return redirect(route('photo.index'));
    }
}
