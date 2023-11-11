<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;


trait ImageHelper
{

    /**
     * remove image from storge by path
     *
     * @return bool
     */
    public function deleteImage(string $imagePath): bool
    {
        if (File::exists($imagePath)) {

            File::delete($imagePath);
        }
        return true;
    }

    public function storeImage(&$image, $path): string
    {
        $Imagename = uniqid() . "." . $image->extension();
        $image->move(public_path($path), $Imagename);
        return $Imagename;
    }
}
