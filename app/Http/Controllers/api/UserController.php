<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200,$unautorizedStatus = 401;

    public function login(){ 

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $data['token'] = $user->createToken('MyApp')-> accessToken; 
            $data['status'] = $this->successStatus;
            return response()->json(['data' => $data]); 
        } else{ 
            return response()->json(['error'=>'Unauthorised','status' => 401]); 
        } 

    }

    public function register(Request $request){ 
        
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
        ]);

		if ($validator->fails()) { 
            $data['error'] = $validator->errors();
            $data['status'] = $this->unautorizedStatus ;
            return response()->json(['data' => $data]);            
        }

		$input = $request->all(); 
		$input['password'] = bcrypt($input['password']); 
		$user = User::create($input); 
		$data['token'] =  $user->createToken('MyApp')-> accessToken; 
        $data['name'] =  $user->name;
        $data['status'] = $this-> successStatus;
		return response()->json(['data' => $data]); 
    }


    public function details() 
    { 
        $data['user'] = Auth::user(); 
        $data['status'] = $this-> successStatus;
        return response()->json(['data' => $data]); 
    }
}
