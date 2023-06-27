<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Storage;

class UploadController extends BaseController
{

    public function upload(Request $request)
    {
        $request->validate([
            'json' => 'required|mimes:json|max:2048',
        ]);

        $request->file('json')->store('json', ['disk' => 'public']);

        return redirect('/')->with('success', 'JSON file uploaded successfully!');
    }

}
