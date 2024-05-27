<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    // Upload photo page
    public function upload()
    {
        return view('photos.upload');
    }

    // Store photo page
    public function store(Request $request)
    {
        // Validate submitted image
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'data' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Try to upload image
        try {
            $imageName = time() . '.' . $request->data->extension();
            $request->data->move(public_path('images'), $imageName);

            // Save image to database
            $product = new Photo();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->data = 'images/' . $imageName;
            $product->save();

            // If succesfull upload, return to upload page with success message
            return redirect()->route('photo.index')->with('success', 'Photo uploaded successfully.');
        } catch (\Exception $e) {
            // If upload unsuccesfull, return to upload page with error
            return redirect()->route('photos.upload')->with('error', 'Photo upload failed. Please try again.');
        }
    }

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
