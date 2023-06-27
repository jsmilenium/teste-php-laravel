<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProcessJobController extends BaseController
{

    public function process()
    {
        $folder = Storage::disk('public')->path('json');
        $files = File::files($folder);

        foreach ($files as $file) {
            $contents = File::get($file);
            $data = json_decode($contents, true);
            ProcessUploadJob::dispatch($data);
        }
        $this->deleteAllFiles();

        return redirect('/')->with('success', 'Queue processed successfully!');
    }

    private function deleteAllFiles()
    {
        $files = File::files(Storage::disk('public')->path('json'));
        foreach ($files as $file) {
            File::delete($file);
        }
    }

}
