<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\RedirectResponse;

class PythonAPIController extends Controller
{
    public function upload_file(Request $request)
    {
        $response = null;
        $post = null;

        // check file is present and has no problem uploading it
        if ($request->hasFile('document')) {
            // get Illuminate\Http\UploadedFile instance
            $document = $request->file('document');
            $name = $document->getClientOriginalName();

            // post request with attachment
            $response = Http::withHeaders([
                'x-api-key' => 'c4720248f1cf85571ba8a3ca',
            ])->attach('file', file_get_contents($document), $name)
                ->post('http://127.0.0.1:5000/ms/uploader', $request->all());
        }

        $post = $request->post;

        Posts::create([
            'userId' => $request->user()->id,
            'classId' => $request->classId,
            'post' => $post,
            'file' => $response
        ]);

        return redirect(url()->previousPath());
    }

    function upload(Request $request){

        return $this->upload_file($request);
    }
}
