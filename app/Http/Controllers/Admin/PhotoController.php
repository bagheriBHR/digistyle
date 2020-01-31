<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function upload(Request $request)
    {
        $photo = $request->file('file');
        $name = time() . $photo->getClientOriginalName();
        Storage::disk('public')->putFileAs('photos',$photo,$name);
        $newPhoto = new Photo();
        $newPhoto->original_name = $photo->getClientOriginalName();
        $newPhoto->path = $name;
        $newPhoto->save();

        return response()->json(['photo_id' => $newPhoto->id]);
    }
}
