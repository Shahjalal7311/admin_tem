<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Media;

class DropZoneController extends Controller
{

  /**
   * Image Upload Code
   *
   * @return void
  */
  public static function storeMedia(Request $request){
    $path = storage_path('tmp/uploads');
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $file = $request->file('file');

    $name = uniqid() . '_' . trim($file->getClientOriginalName());
   
    $file->move($path, $name);
    return response()->json([
        'name'          => $name,
        'original_name' => $file->getClientOriginalName(),
    ]);
  }

  public function destroy(Request $request){
    $id = $request['id'];
    $mediaItems = Media::where('id', $id)->first();
    if($mediaItems){
      $mediaItems->delete();
      $path = 'public/'.$mediaItems->id;
      Storage::deleteDirectory($path);
      echo  1;
    }else{
      echo 0;
    }
  }

}