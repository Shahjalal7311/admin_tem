<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Authorizable;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Common\FileUploadComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Post;
use File;
use Image;
use PDF;

class PostController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Post::latest()->with('user')->orderBy('id', 'desc')->paginate();
        return view('admin.post.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:10',
            'body' => 'required'
        ]);

        // $check_has = $request->hasFile('image_name');
        // $file_name = $request->file('image_name');
        // $name = time().'.'.$file_name->getClientOriginalExtension();
        // $path_url = public_path('/uploads/posts');
                // if($data){
        //     $path = $path_url.'/'.$data->id;
        //     //main image create thum 100px size
        //     $destinationPath = $path_url.'/'.$data->id.'/100/';
        //     File::makeDirectory($destinationPath, $mode = 0777, true, true);
        //     $img = Image::make($file_name->getRealPath());
        //     $watermark =  public_path('img/logo.png');
        //     //set watermark
        //     $this->watermarkset($img,$watermark,$destinationPath, $name, $position='center');
        //     //file uploads
        //     File::makeDirectory($path, $mode = 0777, true, true);
        //     FileUploadComponent::upload($check_has,$file_name, $path, $name);
        // }
        //thum 
        $post = new Post;  
        $post->title = $request->title; 
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        if($request->image_name){
          $this->_fileUpload($request, $post);
        }
        $post->save();
        flash('Post has been added');
        return redirect()->back();
    }

    /**
      * Watermark
      *
      * @param string  $path
      * @param integer $opacity
      *
      * @return Imagine
    */

    public function watermarkset($img,$watermark,$destinationPath, $name, $position = 'center'){
        $img->insert($watermark, $position, 100, 100);
        $img->resize(600, 600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$name);
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|min:10',
            'body' => 'required|min:20',
        ]);
        $me = $request->user();
        if( $me->hasRole('Admin') ) {
            $post = Post::findOrFail($post->id);
        } else {
            $post = $me->posts()->findOrFail($post->id);
        }
        // $check_has = $request->hasFile('image_name');
        // if($check_has){
        //     $file_name = $request->file('image_name');
        //     $name = $todate.'.'.$file_name->getClientOriginalExtension();
        //     $path_url = public_path('/uploads/posts');
        //     $path = $path_url.'/'.$post->id;
        //     $destinationPath = $path_url.'/'.$post->id.'/100/';
        //     File::makeDirectory($destinationPath, $mode = 0777, true, true);
        //     $img = Image::make($file_name->getRealPath());
        //     $watermark =  public_path('img/logo.png');
        //     //set watermark
        //     $this->watermarkset($img,$watermark,$destinationPath, $name, $position='center');
        //     //file uploads
        //     $imagename = FileUploadComponent::upload($check_has,$file_name, $path, $name);
        // }else{
        //     $imagename = $post->image_name;
        // }
        $post_data = [
            'title'=>$request->title,
            'body'=>$request->body,
        ];
        if($request->image_name){
          $this->_fileUpload($request, $artical);
        }
        $query = Post::where('id', $post->id)->update($post_data);
        flash()->success('Post has been updated.');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
    */
    
    public function destroy(Post $post)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $post = Post::findOrFail($post->id);
        } else {
            $post = $me->posts()->findOrFail($post->id);
        }

        $post->delete();

        flash()->success('Post has been deleted.');

        return redirect()->route('posts.index');
    }

    public function csvupload(){
        return view('post.importcsv');
    }

    /**
     * Import xlx, csv file .
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                        $insert[] = [
                        'id' => $value->id,
                        'title' => $value->title,
                        'body' => $value->body,
                        ];
                    }
 
                    if(!empty($insert)){
 
                        $insertData = DB::table('posts')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function printPDF(Request $request, $id = NULL)
    {
        $post = Post::findOrFail($request->id);
        $file_name = 'post_'.$request->id.'.pdf';
        $pdf = PDF::loadView('admin.post.pdf_view', ['data' =>$post]);  
        return $pdf->download($file_name);
    }

    /**
     * File the Upload resource from storage.
     *
     * @param  \App\LocationPoint  $locationPoint
     * @return \Illuminate\Http\Response
    */
    public function _fileUpload($request, $artical){
      foreach ($request->image_name as $file) {
        $artical->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('post');
      }
    }
}
