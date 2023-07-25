<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Services\Api\AuthService;
use App\Services\Api\CategoryServices;
use App\Services\Api\ItemService;
use App\Services\Api\Bannerservice;
use App\Services\Api\OrderService;
use App\Services\Api\RatingService;
use App\Services\Api\GloalService;
use App\Services\HelperService;
use App\Services\UserService;


use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected 
    $helperService, $userService,$orderservice,$apiratingService,$apiglobalService, 
    $apiAuthService,$walletService,$categoryservice,$itemservice,$bannerservice,
    $apicommonService,$apibannerService
    ,$apipromocodeService,$apiserviceService,$apiclothtypeService,$apibagService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->userService = new UserService();     
        $this->apiAuthService = new AuthService();
        $this->categoryservice = new CategoryServices();
        $this->itemservice = new ItemService();
        $this->bannerservice = new Bannerservice();
        $this->orderservice = new OrderService();
        $this->apiratingService = new RatingService();
        $this->apiglobalService = new GloalService();
    }

    /**
     * Authenticate user Check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(ApiLoginRequest $request)
    {
    
        return $this->apiAuthService->login($request);
    }

    /**
     * Register user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userRegister(ApiRegisterRequest $request)
    {
        
        $request->merge(['role' => 'Customer']);  
        return $this->apiAuthService->userRegister($request);
    }


     /**
     * Send Otp
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function sendOtp(Request $request)
    {
        return $this->apiAuthService->sendOtp($request);
    }
    
    /**
     * Verify Otp
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function verifyOtp(Request $request)
    {
        $request->merge(['role' => 'customer']);
        return $this->apiAuthService->verifyOtp($request);
    }


    /**
     * Profile By Token
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile()
    {
       
        return $this->apiAuthService->userProfile();
    }


     /**
     * Update User Profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function profileUpdate(Request $request)
     {  
        return $this->apiAuthService->profileUpdate($request);
     }

     /**
     * get Category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getCategory(Request $request)
    {  
       return $this->categoryservice->getCategory($request);
    }

     /**
     * get Item
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getProduct(Request $request)
     {  
        return $this->itemservice->getProduct($request);
     }

     /**
     * get banner list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getBanner(Request $request)
     {  
        return $this->bannerservice->getBanner($request);
     }

     /**
     * add order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function addOrder(Request $request)
     {  
        return $this->orderservice->addOrder($request);
     }

     /**
     * add rating
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function addRating(Request $request)
     {  
        return $this->apiratingService->addRating($request);
     }

     /**
     * add rating
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getsettingdata(Request $request)
     {  
        return $this->apiglobalService->getsettingdata($request);
     }

     /**
     * cancel order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function cancelOrder(Request $request)
     {  
        return $this->orderservice->cancelOrder($request);
     }

     /**
     * Forget Password
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function forgetPassword(Request $request)
    {
        
        return $this->apiAuthService->forgetPassword($request);
    }

     /**
     * Delete User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function deleteAccount(Request $request)
    {      
        return $this->apicommonService->deleteAccount($request);
    }

     /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)
    {
        return $this->apiAuthService->logout($request);
    }
   
}