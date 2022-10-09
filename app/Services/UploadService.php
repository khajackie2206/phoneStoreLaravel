<?php

namespace App\Services;

use Exception;

/**
 * Class ProductService.
 */
class UploadService
{
    public function create($request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads');
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/storage' . '/' .$pathFull . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }
}
