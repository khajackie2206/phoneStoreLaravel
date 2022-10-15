<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UploadService;
use Illuminate\Support\Facades\Validator;
use Exception;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => ['required', 'mimes:jpeg,png,jpg,gif'],
        ]);
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json([
                'error' => true
            ]);
        }

        $url = $this->upload->create($request);
        if ($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
    public function multiStore(Request $request)
    {

        $pathCompletely = [];
        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {

                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $path = $file->store('uploads');
                    $name = $file->getClientOriginalName();
                    $pathFull = 'uploads/' . date("Y/m/d");
                    $path = $file->storeAs(
                        'public/' . $pathFull,
                        $name
                    );
                    array_push($pathCompletely,  '/storage/' . $pathFull . '/' . $name);
                }
            }
            $pathCompletely = json_encode($pathCompletely);
            return response()->json([
                'error' => false,
                'url' => $pathCompletely
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
}
