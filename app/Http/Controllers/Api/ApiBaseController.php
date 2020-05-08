<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ApiBaseController extends Controller{

	public function sendResponse($result, $message, $code = 404){
		$response = [
			'success' => true,
			'status' =>$code,
			'data' => $result,
			'message' => $message,
		];
		return response()->json($response, 200);
	}

	public function sendError($error, $errorMessages = [], $code = 404){
		$response = [
			'success' => false,
			'status' =>$code,
			'message' => $error,
		];
		if(!empty($errorMessages)){
			$response['data'] = $errorMessages;
		}
		return response()->json($response, $code);
	}
}