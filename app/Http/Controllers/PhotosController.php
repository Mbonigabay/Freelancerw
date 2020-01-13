<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if ($photo) {
            $photo->delete();
            return back()
                ->with('success', 'Photo deleted successfully');
        }

        return back()->withInput()->with('error', 'Photo could not be deleted');
    }

    public function upload(Request $request)
    {
        $user = Auth::user();
        $photos = Photo::where('user_id', $user->id)->get();
        $body = $request->input('body');

        // Handle the user upload of picture
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            Image::make($picture)->save(public_path('/pictures/' . $filename));
            $photo = Photo::create([
                'picture' => $filename,
                'body' => $body,
                'user_id'=> Auth::user()->id
            ]);
            if($photo){
                return back()->with('success', 'Picture added successful');
            }

        }
        return back()->withInput()->with('error', 'Error uploading new photo');
    }

    public function viewPicByUser($id)
    {
        $photos = Photo::where('user_id', $id)->first();

        return view('users.show', ['photos' => $photos]);

    }
}
