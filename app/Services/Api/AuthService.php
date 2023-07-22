<?php

namespace App\Services\Api;
use App\Http\Requests\Admin\ContactUsRequest;
use App\Models\MasterOtp;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Validator;
use App\Services\UserService;
use App\Services\HelperService;
use App\Services\FileService;
use App\Services\OrderService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class AuthService
{
     /**
     * Authenticate user Check and login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public static function login(Request $request) 
    {
    
        // $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = User::where('email',$request->email)->first();
       
        if (!$user) {
            return response()->json(
                [
                    'status' => false,
                    'message' => "You don't have an account with us, Please create your account with us and then login.",
                    'type' => 'unauthorized',
                ],
                200
            );
        }

        $credentials = $request->only(['email','password','login_type']);
      

        $credentials['status'] = 0;
        $token = auth('api')->attempt($credentials, ['exp' => Carbon::now()->addDays(60)->timestamp]);


        if (!$token) {
            if ($user->status == 1) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Your account has been deactivated by admin. Please contact to Support Team.',
                        'type' => 'blocked',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Oops!, You have provide incorrect credentials.',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
        }
        $user = JWTAuth::setToken($token)->toUser();

        if(!empty($user->profile)){
            $user->profile=FileService::image_path($user->profile);
            }
           


        if ($user->status == 0) {
            // UserService::updateLastLogin($user->id, $request);
                if(!empty($request->fcm_token)){
            $data=array('fcm_token'=>$request->fcm_token);
            $result=DB::table('users')->where('email', $request->email)->update($data);    
                }
                return response()->json(
                [
                    'status' => true,
                    'message' => 'Login Successfully',
                    'token' => $token,
                    'data' => $user
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Your Account is Blocked or Unverify Please Connect with Support!',
                    'type' => 'blocked',
                ],
                200
            );
        }
    }
   

    /**
     * Register user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function userRegister(Request $request)
    {
        $is_register = false;
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'You have an account, Please login with same credentials.',
                    'type' => 'unauthorized',
                ],
                200
            );
        } else {
            $is_register = true;
            $input = array_merge(
                $request->except(['_token']),
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'login_type'=>$request->login_type,
                    'status'=>0,
                    'is_active'=>0,
                    'fcm_token' => $request->fcm_token,
                    'country_code' => $request->country_code,    
                ]
            );


            if(!empty($input['image'])){
                $picture=FileService::imageUploader($request,'image','profile/image/');
                $input['image']= $picture; 
            }
            
            $user = UserService::create($input);
            
            $token = auth('api')->login($user, ['exp' => Carbon::now()->addDays(120)->timestamp]);
            
            if (!$token) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'unauthorized',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }

            $user = JWTAuth::setToken($token)->toUser();
    
            if(!empty($user->profile)){
                   $user->profile=FileService::image_path($user->profile);
            }
           
            if ($user->status == 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'User Registerd Successfully',
                        'is_register' => $is_register,
                        'token' => $token
                        
                    ],
                    200
                );
                

            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Deactive user',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
        }
    }


        /**
     * Send Otp
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public static function sendOtp(Request $request)
    {
        try{
            
            $userdata=DB::table('users')->where('email',$request->email)->first();
            $userphonedata=DB::table('users')->where('phone',$request->email)->first();
       
             if(!empty($userdata)){         
                
                 $otp = HelperService::createOtp();
                 $input = [
                 'phone' => $request->email,
                 'otp' => $otp,
                 'role' => 2,
                     ];    
                     $user=User::where('email',$request->email)->first();
                       if(!empty($user)){ 
                             MasterOtp::create($input); 
                             $detail=array();
                             $detail['title']='Otp Verification';
                             $detail['otp']=$otp;     
                              UserService::register_mail($detail,$request->email);
                        
                     return response()->json(
                     [
                         'status' => true,
                         'message' => 'Otp Sent Successfully',
                         'data'=>$user,
                     ],
                     200
                     );
                       }else{
                         return response()->json(
                             [
                                 'status' => false,
                                 'message' => 'User not Registerd with us',                                
                             ],
                             200
                             );
                       }
 
             }elseif(!empty($userphonedata)){
                
                 $userdata=User::where('phone',$request->email)->first(); 

                 if(!empty($userdata)){
                     $otp = HelperService::createOtp();
                     $input = [
                     'phone' => $userdata->phone,
                     'otp' => $otp,
                     'role' => 2,
                         ];  
                         
                         $user=User::where('phone',$userdata->phone)->first();
                             if(!empty($user)){
                                 if(env('PRODUCTION', true)){
                                     HelperService::sendMessageTwilio($request->country_code,$request->phone,'Your Verification OTP Is',$otp);
                                     } else{
                             MasterOtp::create($input);  
                                     }
                                 return response()->json(
                                 [
                                     'status' => true,
                                     'message' => 'Otp Sent Successfully',
                                     'data' =>$user,
                                 ],
                                 200
                                 );
                             }else{
                                 return response()->json(
                                     [
                                         'status' => false,
                                         'message' => 'User not Registerd with us',
                                         
                                     ],
                                     200
                                     );
                             }
                    }
             }else{
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'User not Registerd with us',
                        
                    ],
                    200
                    );
             }
         }catch(\Exception $e){
             return response()->json([
                 'success'=>false,
                 'message'=>$e->getMessage()
             ]);
        
         }
    }



 /**
     * Verify Otp
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public static function verifyOtp(Request $request)
    {
            try{
                $data = MasterOtp::where('phone', $request->phone)
                ->where('otp', $request->otp)
                ->orderBy('created_at', 'desc')
                // ->whereBetween('created_at', [now()->subMinutes(10), now()])
                ->first();
                    
                        if ($data) { 
                            return response()->json([
                                'status' => true, 
                                'message' => 'Otp Verify Successfully',
                          
                            ], 200);
                        }
                        else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Wrong OTP',
                                'errors' => ['otp' => ['Wrong OTP']]
                            ], 200);
                        }
                
            }catch(Exception $e){
                return $e;
            }       
    }


   
 /**
     * Forget Password
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function forgetPassword(Request $request){
        $request->validate([
            'password' => 'min:6',
            'c_password' => 'required_with:password|same:password|min:6'
        ]);
            $user = User::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();
            if($user){
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Password  Update Successfully'
                       
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Password Not Updated',
                        'data' =>[],
                    ],
                    200
                );
            }
    }




    
    /**
     * Get Profile By Token
     *
     * @return \Illuminate\Http\Response
     */

     public static function  userProfile()
     { 
         $profile = User::where('id',auth()->user()->id)->get();
                 foreach($profile as $data){
                    if(!empty($data->image)){
                        $data->image=FileService::image_path($data->image);
                        }
                             }
         
         if ($profile) {
                 return response()->json(
                         [
                             'status' => true,
                             'message' => 'Profile Find successfully',
                             'data' => $profile
                           
                         ],
                         200
                     );
                 } else {
                     return response()->json(
                         [
                             'status' => false,
                             'message' => 'Data not Found',
                             'data' =>[],
                         ],
                         200
                     );
                 }
     }






    
     /**
     * Update User Profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function profileUpdate(Request $request)
    {  
       
             $input=array();
             if(!empty($request->name)){
             $input['name']=$request->name;
             } 
             if(!empty($request->email)){
             $input['email']=$request->email; 
             }

             if(!empty($request->phone)){
             $input['phone']=$request->phone;
             }
            
             if(!empty($request->profile)){
                $profile=FileService::imageUploader($request,'profile','profile/image/');
              $input['profile']= $profile;  
    
          }
          

            $result = User::where('id',auth()->user()->id)->update($input);
            if ($result) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Profile Update Successfully'
                       
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Profile not Updated',
                        'data' =>[],
                    ],
                    200
                );
            }
    }





    public static function logout(Request $request)
    {
        self::getAuthUser();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public static function getAuthUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }







}

