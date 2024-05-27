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
        // Validate submitted image
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Try to upload image
        try {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Save image to database
            $product = new Photos();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = 'images/' . $imageName;
            $product->save();

            // If succesfull upload, return to upload page with success message
            return redirect()->route('photos.upload')->with('success', 'Photo uploaded successfully.');
        } catch (\Exception $e) {
            // If upload unsuccesfull, return to upload page with error
            return redirect()->route('photos.upload')->with('error', 'Photo upload failed. Please try again.');
        }
    }

    // Photo list page
    public function index()
    {
        //
    }
}
