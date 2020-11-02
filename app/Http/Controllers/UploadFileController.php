<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('progress-bar-file-upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $title = time().'.'.request()->file->getClientOriginalExtension();

        dd($title);

        $request->file->move(public_path('docs'), $title);

        $storeFile = new Doc;
        $storeFile->title = $title;
        $storeFile->save();

        return response()->json(['success'=>'File Uploaded Successfully']);
    }
}
