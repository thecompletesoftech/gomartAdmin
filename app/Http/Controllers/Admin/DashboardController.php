<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
        $user = Auth::user();
        return view('admin.test', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        // dd($user);
        // dd($user->getRoleNames(), $user->roles, $user->permissions, $user->getPermissionsViaRoles(), $user->getAllPermissions());

        $data = DB::table('stores')->join('reviewandratings', 'reviewandratings.store_id', '=', 'stores.store_id')->select('stores.*', 'reviewandratings.*')->get();
        $recent_order = Order::with('store', 'driver', 'user')->latest()->take(10)->get();
        $driver_list =
        DB::table('drivers')
            ->join('orders', 'orders.driver_id', '=', 'drivers.driver_id')
            ->select('orders.*', 'drivers.*')
            ->where('order_status', '1')->get();
        return view('admin.dashboard', compact('data','recent_order','driver_list'));
    }

    public function dashboardCountsData()
    {
        $data = DashboardService::adminDataCounts();
        return response()->json([
            'status' => 1,
            'message' => 'Dashboard Data Get Successfully ',
            'data' => $data,
        ]);
    }
}
