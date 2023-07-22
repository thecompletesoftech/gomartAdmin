<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Categoryservice;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class CategoryController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/categorys';
        //route
        $this->index_route_name = 'admin.categorys.index';
        $this->create_route_name = 'admin.categorys.create';
        $this->detail_route_name = 'admin.categorys.show';
        $this->edit_route_name = 'admin.categorys.edit';

        //view files
        $this->index_view = 'admin.category.index';
        $this->create_view = 'admin.category.create';
        $this->edit_view = 'admin.category.edit';

        //service files
        $this->intrestService = new CategoryService();
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

    // public function index(Request $request)
    // {
    //     $items = $this->intrestService->datatable();
    //     if ($request->ajax()) {
    //         return view('admin.category.category_table', ['categorys' => $items]);
    //     } else {
    //         return view('admin.category.index', ['categorys' => $items]);
    //     }
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('categories')->get();
            return DataTables::of($data)->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('category_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['category_name'], $request->get('category_name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['category_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['category_name']), Str::lower($request->get('search')))) {
                                return true;
                            }

                            return false;
                        });
                    }

                })
                ->addColumn('publish', function ($model) {
                    return $model->item_publish == 'Yes' ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                })
                ->rawColumns(['publish'])
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="categorys/'. $row->cat_id .'/edit" class="btn btn-warning btn-sm">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="categorys/destroy/'. $row->cat_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.index');

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

        $logo = $request->file('category_image');
        $picture = FileService::fileUploaderWithoutRequest($logo, 'category/image/');
        $input['category_image'] = $picture;

        $category = $this->intrestService->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'category', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view($this->detail_view, compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view($this->edit_view, compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['category_image'])) {
            $logo = $request->file('category_image');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'category/image/');
            $input['category_image'] = $picture;

        }

        $this->intrestService->update($input, $category);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'category', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('categories')->where('cat_id', $id)->delete();
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

    public function active($id, $status)
    {

        $update = array('status' => $status);
        $result = CategoryService::status($update, $id);
        return redirect()->back()->withSuccess('Status Update Successfully!');

    }

    public function update_status($id, $status)
    {
        $update = array('status' => $status);
        $result = CategoryService::status($update, $id);
        return redirect()->back()->withSuccess('Status Update Successfully!');
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

}
