<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiBaseController as ApiBaseController;
use App\Artical;
use Validator;

class ArticalController extends ApiBaseController{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function index(){
		$artical = Artical::get()->all();
		if($artical){
			$artical = $artical;
			return $this->sendResponse($artical, 'Artical retrieved successfully.', 200);
		}else{
			$artical = [];
			return $this->sendError($artical, 'Artical retrieved failed.',400);
		}
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/

	public function store(Request $request){
		$input = $request->all();
		$validator = Validator::make($input, [
			'title' => 'required',
			'body' => 'required'
		]);
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$artical = Post::create($input);
		return $this->sendResponse($artical->toArray(), 'Post created successfully.');
	}

	/**
	* Display the specified resource.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/

	public function show($id){
		$artical = Artical::find($id);
		if (is_null($artical)) {
		return $this->sendError('Post not found.');
		}
		return $this->sendResponse($artical->toArray(), 'Post retrieved successfully.');
	}

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id){
		$input = $request->all();
		$validator = Validator::make($input, [
			'title' => 'required',
			'body' => 'required',
		]);
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$artical = Artical::find($id);
		if (is_null($artical)) {
			return $this->sendError('Post not found.');
		}
		$artical->title = $input['title'];
		$artical->body = $input['body'];
		$artical->save();
		return $this->sendResponse($artical->toArray(), 'Post updated successfully.');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/

	public function destroy($id){
		$artical = Artical::find($id);
		if (is_null($artical)) {
			return $this->sendError('Post not found.');
		}
		Artical::where('id', $artical->id)->update(['is_delete'=>'0']);
			return $this->sendResponse($id, 'Tag deleted successfully.');
	}
}