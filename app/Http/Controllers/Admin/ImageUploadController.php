<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Intervention\Image\Facades\Image;


class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function imageUpload(string $name, int $height, int $width, string $path, $file):string
    {
        $image_Name = $name.'.webp';
        Image::make($file)
        ->fit($width, $height)
        ->save(public_path($path).$image_Name, 50, 'webp');

        // Image::make( $file->getRealPath() )->fit(340, 340)->save('public/cover_images/' . $thumbnailpic);

        return $image_Name;
    }
    public static function imageUnlink($path, $name, string $id):void
    {
        $image_path = public_path($path).$name;
        if (file_exists($image_path)){
            unlink($image_path);    
        }
        $post = Post::find($id);

        if(file_exists('uploads/post/'.$post->image)){
            unlink('uploads/post/'.$post->image);
        };
        $post->delete();
    }
}

