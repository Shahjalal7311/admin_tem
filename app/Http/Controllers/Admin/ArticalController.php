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
  		'body' => 'required'
  	]);
  	$has_file = $request->hasFile('image_name');
  	$imgname = '';
  	if($has_file){
  		$cover = $request->file('image_name');
	  	$re_name = time();
	    $extension = $cover->getClientOriginalExtension();
	    Storage::disk('public')->put('/articals/'.$re_name.'.'.$extension,  File::get($cover));
	    $imgname =  time().'.'.$cover->getClientOriginalExtension();
  	}
  	$artical = new Artical;
  	$artical->title = $request->title;
  	$artical->image_name = $imgname;
  	$artical->user_id = auth()->user()->id;
  	$artical->body = $request->body;
  	$artical->save();
  	flash('Artical added successfully...');
    return redirect()->back();
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
        $todate = date("Y-m-d-H-i-s");
        $this->validate($request, [
            'title' => 'required|min:10',
            'body' => 'required|min:20',
        ]);
        $me = $request->user();
        if( $me->hasRole('Admin') ) {
            $artical = Artical::findOrFail($artical->id);
        } else {
            $artical = $me->articals()->findOrFail($artical->id);
        }
        // $check_has = $request->hasFile('image_name');
        // $file_name = $request->file('image_name');
        // $name = $todate.'.'.$file_name->getClientOriginalExtension();
        // $path_url = public_path('/uploads/articals');
        // $path = $path_url.'/'.$artical->id;
        // $imagename = FileUploadComponent::upload($check_has,$file_name, $path, $name);
        // $save_data = [
        //     'title'=>$artical->title,
        //     'body'=>$artical->body,
        //     'image_name'=>$imagename,
        // ];
        $has_file = $request->hasFile('image_name');
        $imgname = '';
        if($has_file){
          $cover = $request->file('image_name');
          $re_name = time();
          $extension = $cover->getClientOriginalExtension();
          Storage::disk('public')->put('/articals/'.$re_name.'.'.$extension,  File::get($cover));
          $imgname =  time().'.'.$cover->getClientOriginalExtension();
        }else{
          $imgname = $artical->image_name;
        }
        $update_data = [
            'title'=>$request->title,
            'body'=>$request->body,
            'image_name'=>$imgname,
        ];
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
        $me = Auth::user();

        if($me->hasRole('admin')){
            $post = Artical::findorFail($artical->id);
        }else{
            $post = $me->artical()->findorFail($artical->id);
        }

        Artical::where('id',$post->id)
                ->update([
                    'is_delete'=>'0',
                    'delete_by'=>$post->user_id,
                ]);
        flash()->success('Post has been deleted.');
        return redirect()->route('articals.index');        
    }

}
