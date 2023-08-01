<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driverpayout;
use App\Services\DriverPayoutService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class Driverpayoutcontroller extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $driverpayoutService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/driverpayouts';
        //route
        $this->index_route_name = 'admin.driverpayouts.index';
        $this->create_route_name = 'admin.driverpayouts.create';
        $this->detail_route_name = 'admin.driverpayouts.show';
        $this->edit_route_name = 'admin.driverpayouts.edit';

        //view files
        $this->index_view = 'admin.driverpayout.index';
        $this->create_view = 'admin.driverpayout.create';
        $this->edit_view = 'admin.driverpayout.edit';

        //service files
        $this->driverpayoutService = new DriverPayoutService();
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
        if ($request->ajax()) {

            $data = DB::table('driverpayouts')->get();

            return DataTables::of($data)->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('driver_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['driver_name'], $request->get('driver_name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['driver_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['driver_name']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="driverpayouts/'. $row->driver_id .'/edit" class="btn btn-warning btn-sm" style="display:none;">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="driverpayouts/destroy/'. $row->driver_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" 
                    style="display:none;"
                    >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
          
        }
        return view('admin.driverpayout.index');
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
        $category = $this->driverpayoutService->create($input);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'driverpayout', 1));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Driverpayout $driverpayout)
    {
        return view($this->detail_view, compact('driverpayout'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Driverpayout $driverpayout)
    {
        return view($this->edit_view, compact('driverpayout'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Driverpayout $driverpayout)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->intrestService->update($input, $driverpayout);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'driverpayout', 1));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('driverpayouts')->where('driver_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    
}