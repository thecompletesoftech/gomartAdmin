<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Services\Api\AuthService;
use App\Services\Api\Bannerservice;
use App\Services\Api\CartItemService;
use App\Services\Api\CategoryServices;
use App\Services\Api\CouponCodeService;
use App\Services\Api\GloalService;
use App\Services\Api\ItemService;
use App\Services\Api\OrderService;
use App\Services\Api\RatingService;
use App\Services\Api\CheckoutService;
use App\Services\Api\SubcategoryServices;
use App\Services\Api\PlaceorderService;
use App\Services\HelperService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $helperService, $userService, $orderservice, $apiratingService, $apiglobalService,
    $apiAuthService, $walletService, $categoryservice, $itemservice, $bannerservice,
    $apicommonService, $apibannerService
    , $apipromocodeService, $apiserviceService,
    $apiclothtypeService,
    $apibagService, $cartService, $subcategoryService, $coupancodeservice,$checkoutservice,$placeorderservice;

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
        $this->cartService = new CartItemService();
        $this->subcategoryService = new SubcategoryServices();
        $this->coupancodeservice = new CouponCodeService();
        $this->checkoutservice = new CheckoutService();
        $this->placeorderservice = new PlaceorderService();
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
     * get SubCategory
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getSubcategory(Request $request)
    {
        return $this->subcategoryService->getSubcategory($request);
    }

    /**
     * get Product By Category Id
     * *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getProductByCatID(Request $request)
    {
        return $this->itemservice->getProductByCatID($request);
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
     * get Item By Id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getProductByItemID(Request $request)
     {
         return $this->itemservice->getProductByItemID($request);
     }

    /**
     * Item Add to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function Addcart(Request $request)
    {
        return $this->cartService->Addcart($request);
    }

    // start add coupon code
    public function addCouponcode(Request $request)
    {
        return $this->coupancodeservice->addCouponcode($request);
    }
    // end coupon code

    // start coupon code list
    public function getCouponcode(Request $request)
    {
        return $this->coupancodeservice->getCouponcode($request);
    }
    // end conpon code list

    // start Remove Coupon Code
    public function RemoveCouponcode(Request $request)
    {
        return $this->coupancodeservice->RemoveCouponcode($request);
    }
    // end Remove Coupon Code

    // Start Remove Add To Cart
    public function RemoveAddcart(Request $request)
    {
        return $this->cartService->RemoveAddcart($request);
    }
    // End Remove Add To Cart

    // Start Get Cart Item
    public function getCartItem(Request $request)
    {
        return $this->cartService->getCartItem($request);
    }
    // End Get Cart Item

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
     * delete order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function deleteOrder(Request $request)
    {
        return $this->orderservice->deleteorder($request);
    }

    /**
     * get OrdersDetail
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getOrderdetail(Request $request)
    {
        return $this->orderservice->getOrderdetail($request);
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
     * Checkout list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function Checkoutlist(Request $request)
    {
        return $this->checkoutservice->Checkoutlist($request);
    }

    /**
     * Place Order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function Placeorder(Request $request)
     {
         return $this->placeorderservice->Placeorder($request);
     }

     /**
     * Checkout 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function Checkout(Request $request)
     {
         return $this->checkoutservice->Checkout($request);
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
