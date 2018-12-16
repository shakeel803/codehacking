<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Requests\MediaUploadRequest;
use App\Photo;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }


    public function create()
    {
        return view('admin.media.create');
    }

    public function store(MediaUploadRequest $request)
    {
        $file = $request->file('file');

        $name = time().'_'.$file->getClientOriginalName();

        Photo::create(['file'=>$name]);
        $file->move('images/',$name);
        Session::flash('msg','File has been uploaded.');
        return redirect('admin/media');
    }

    public function destroy($id)
    {
        $media = Photo::findOrFail($id);

        unlink(public_path().$media->file);

        $media->delete();
        Session::flash('msg','File has been deleted.');
        return redirect('admin/media');
    }
}
