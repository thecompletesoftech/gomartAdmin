<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ManagerLanguageService;
use App\Services\Orderservice;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class OrderController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name, $print_view;
    protected $intrestService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/orders';
        //route
        $this->index_route_name = 'admin.orders.index';
        $this->create_route_name = 'admin.orders.create';
        $this->detail_route_name = 'admin.orders.show';
        $this->edit_route_name = 'admin.orders.edit';

        //view files
        $this->index_view = 'admin.order.index';
        $this->create_view = 'admin.order.create';
        $this->edit_view = 'admin.order.edit';
        $this->print_view = 'admin.order.print';

        //service files
        $this->intrestService = new Orderservice();
        // $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $query = Order::join('users', 'users.id', '=', 'orders.user_id')
                ->select('orders.order_no', 'users.name as user_name');

                // if ($request->has('driver_name')) {
                //     $name = $request->input('driver_name');
                //     $query->where(function ($query) use ($name) {
                //         $query->whereRaw('LOWER(driver_name) LIKE ?', ['%' . strtolower($name) . '%'])
                //             ->orWhereRaw('UPPER(driver_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                //     });
                // }

            print_r($query);

        // if ($request->ajax()) {



            // return DataTables::of($query)->addIndexColumn()
            //     ->addColumn('order_status', function ($model) {
            //         return $model->order_status == 0 ? 'Pending' :
            //         ($model->order_status == 1 ? 'Complete' : 'Cancel');
            //     })
            //     ->addColumn('action', function ($row)
            //     {
            //         $printbtn = '<a href="orders/print/' . $row->order_id . '" class="badge badge-warning p-2" ><i class="fa fa-eye" style="color:white;"></i></a>';
            //         $btn1 = '&nbsp;<a href="orders/' . $row->order_id . '/edit" class="badge badge-success p-2"><i
            //         class="fa-regular fa-pen-to-square"
            //         style="color:white;"></i></a>';
            //         $btn2 = '&nbsp;<a href="orders/destroy/' . $row->order_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
            //         <i class="fa-solid fa-trash-can" style="color:white;"></i>
            //         </a>';
            //         return $printbtn." ".$btn1." ".$btn2;
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
        // }

        return view('admin.order.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view($this->create_view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserIntrestRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $category = $this->intrestService->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'order', 1));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Order $order)
    {
        $data['user'] = Order::with('user','store')->where(['order_id' => $order->order_id])->first();
        $data['orderitem'] = OrderItem::where(['order_id' => $order->order_id])->get();

        return view($this->edit_view, compact('order'),$data);
    }

    public function show(Order $order)
    {
        // return view($this->detail_view, compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->intrestService->update($input, $order);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'order', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('orders')->where('order_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->intrestService->updateById(['is_active' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error',
            ]);
        }
    }

    public function print($id) {

        $data['user'] = Order::with('store','user')->where(['order_id' => $id])->first();
        $data['orderitem'] = OrderItem::where(['order_id' => $id])->get();
        return view($this->print_view, compact('data'),$data);
    }

}
