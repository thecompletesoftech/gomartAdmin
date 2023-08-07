<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupan;
use App\Services\Coupanservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class CoupanController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $coupanService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/coupans';
        //route
        $this->index_route_name = 'admin.coupans.index';
        $this->create_route_name = 'admin.coupans.create';
        $this->detail_route_name = 'admin.coupans.show';
        $this->edit_route_name = 'admin.coupans.edit';

        //view files
        $this->index_view = 'admin.coupan.index';
        $this->create_view = 'admin.coupan.create';
        $this->edit_view = 'admin.coupan.edit';

        //service files
        $this->coupanService = new Coupanservice();
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

            $query = Coupan::query();

            if ($request->has('coupan_code')) {
                $name = $request->input('coupan_code');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(coupan_code) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(coupan_code) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return DataTables::of($query)->addIndexColumn()
                ->addColumn('coupan_status', function ($model) {
                    return $model->coupan_status == 0 ? 'Active' : 'Deactive';
                })
                ->rawColumns(['coupan_status'])
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="coupans/'. $row->coupan_id .'/edit" class="btn btn-warning btn-sm">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="coupans/destroy/'. $row->coupan_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.coupan.index');
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
        $category = $this->coupanService->create($input);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'currency', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Coupan $coupan)
    {
        return view($this->detail_view, compact('coupan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupan $coupan)
    {
        return view($this->edit_view, compact('coupan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupan $coupan)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->coupanService->update($input, $coupan);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'coupan', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('coupans')->where('coupan_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }


  

}