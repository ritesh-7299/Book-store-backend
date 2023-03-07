<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    use HasApiTokens;

    /**
     * Register function to register admin
     * normally it is not good practice to make admin registrable 
     * but for easiness in testing i have done it.
     * 
     * @param  \Illuminate\Http\Request   $request 
     * @return JsonResponse
     */
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|same:password',
            ],[
                'password.regex' => "Password should have at least one uppercase letter,
                one lower case letter, one numeric value, one special character and must be more than 6 characters long."
            ]);
    
            if($validator->fails()){
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                
                return response()->json($response,400);
            }
    
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            
            $success['token'] = $user->createToken('Myapp')->plainTextToken;
            $success['name'] = $user->name;
    
            $response = [
                'success' => true,
                'data' => $success,
                'message' => ['message'=>['User registration successful']]
            ];
    
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e->getMessage() 
            ];

            return response()->json($response,500);
        }
    }

    /**
     * login function to authenticate the admin credentials and 
     * make admin logged in.
     *
     * @param  \Illuminate\Http\Request   $request 
     * @return JsonResponse
     */
    
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if($validator->fails()){
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                
                return response()->json($response, 400);
            }        
    
            if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
                $user = Auth::user();
    
                $success['token'] = $user->createToken('Myapp')->plainTextToken;
                $success['name'] = $user->name;
    
                $response = [
                    'success' => true,
                    'data' => $success
                ];
                
                return response()->json($response,200);
            }
    
            $response = [
                'success' => false,
                'message' => ['message'=>['Email or Password is invalid']]
            ];
            
            return response()->json($response, 400);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e->getMessage() 
            ];

            return response()->json($response,500);
        }
    }
}
