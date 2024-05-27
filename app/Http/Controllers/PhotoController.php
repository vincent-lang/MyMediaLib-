<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $product = new Photos();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = 'images/' . $imageName;
            $product->save();

            return redirect()->route('photos.upload')->with('success', 'Photo uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('photos.upload')->with('error', 'Photo upload failed. Please try again.');
        }
    }

    // Photo list page
    public function index()
    {
        //
    }
}
