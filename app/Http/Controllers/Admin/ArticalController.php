<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Common\FileUploadComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Artical;
use App\User;
use Image;

class ArticalController extends Controller
{
	/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */
  public function index()
  {
  	try {
  		$result = Artical::latest()->with('user')->paginate();
  	} catch( ModelNotFoundException $exception ) {
  		return back()->withError($exception->getMessage())->withInput();
  	}
    return view('admin.articals.index', compact('result'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
  */
  public function create()
  {
      return view('admin.articals.new');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
  	$this->validate($request,[
  		'title' => 'required|min:10',
        'slug' => 'required',
  		'body' => 'required'
  	]);
  	$artical = new Artical;
  	$artical->title = $request->title;
    $artical->slug = $request->slug;
  	$artical->user_id = auth()->user()->id;
  	$artical->body = $request->body;
    if($request->image_name){
      $this->_fileUpload($request, $artical);
    }
  	$artical->save();
  	flash('Artical added successfully...');
    return redirect('admin/articals');
  }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function edit(Artical $artical)
    {
        $artical = Artical::findorFail($artical->id);
        return view('admin.articals.edit',compact('artical'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artical $artical)
    {
        $this->validate($request, [
            'title' => 'required|min:10',
            'slug' => 'required',
            'body' => 'required|min:20',
        ]);
        $me = $request->user();
        if( $me->hasRole('Admin') ) {
            $artical = Artical::findOrFail($artical->id);
        } else {
            $artical = $me->articals()->findOrFail($artical->id);
        }
        $update_data = [
            'title'=>$request->title,
            'slug'=>$request->slug,
            'body'=>$request->body,
        ];
        if($request->image_name){
          $this->_fileUpload($request, $artical);
        }
        $query = Artical::where('id', $artical->id)->update($update_data);
        if($query){
            $request->session()->flash('success', 'Record successfully added!');
            return redirect()->route('articals.index');
        }else{
            $request->session()->flash('warning', 'Record not added!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artical $artical)
    {
        $artical->delete();
        flash()->success('Post has been deleted.');
        return redirect()->route('articals.index');        
    }

    /**
     * Implement human readble url.
     *
     * @param  \App\Artical  $artical
     * @return \Illuminate\Http\Response
    */

    public function slugCreate(Request $request){
        $slug = SlugService::createSlug(Artical::class,'slug', $request['slug']);
        return response()->json(['slug'=>$slug]);
    }

    /**
     * File the Upload resource from storage.
     *
     * @param  \App\LocationPoint  $locationPoint
     * @return \Illuminate\Http\Response
    */
    public function _fileUpload($request, $artical){
      foreach ($request->image_name as $file) {
        $artical->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('artical');
      }
    } 

}
