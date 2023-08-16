@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('header.dashboard'),
        'breadcrumbs' => Breadcrumbs::render('admin.dashboard'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->

            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card">
                        <!--begin::Body-->
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p mt-20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-users" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_user() }}</h5>
                                        </span>

                                        <a href=" {{ route('admin.users.index') }}" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.new_users', 1) }}
                                        </a>
                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-bag-shopping" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_store() }}</h5>
                                        </span>
                                        <a href="{{ route('admin.stores.index') }}" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_store', 1) }}
                                        </a>
                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-car" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_driver() }}</h5>
                                        </span>
                                        <a href="{{ route('admin.drivers.index') }}" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_driver', 1) }}
                                        </a>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>

            <div class="row gy-3 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card">
                        <!--begin::Body-->
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">

                                    <!--begin::Col-->

                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-cart-shopping" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a href=" {{ route('admin.orders.index') }}" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_orders', 1) }}
                                        </a>
                                    </div>

                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-building-columns" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a href="" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_earning', 1) }} (After taxes)
                                        </a>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7 text-center">
                                        <i class="fa fa-wallet" style="font-size:35px;color:#009EF7;"></i>
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <h5>{{ total_order() }}</h5>
                                        </span>

                                        <a href=" {{ route('admin.orders.index') }}" class="text-primary fw-bold fs-6">
                                            {{ trans_choice('content.dashboard_cards.total_commission', 1) }}
                                        </a>
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>

            <!-- start earning and top stores -->
            <div class="row gy-5 g-xl-8 mt-5 mb-5 d-flex ">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Orders</h3>
                            <label class="mt-8"><i class="fa fa-solid fa-bars"
                                    style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Samso Park</td>
                                            <td>34424433</td>
                                            <td>12 May 2017</td>
                                            <td><label class="badge badge-danger">Pending</label></td>
                                        </tr>
                                        <tr>
                                            <td>Marlo Sanki</td>
                                            <td>53425532</td>
                                            <td>15 May 2015</td>
                                            <td><label class="badge badge-warning">In progress</label></td>
                                        </tr>
                                        <tr>
                                            <td>John ryte</td>
                                            <td>53275533</td>
                                            <td>14 May 2017</td>
                                            <td><label class="badge badge-info">Fixed</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Stores</h4>
                            <a href=" {{ route('admin.stores.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Store</th>
                                            <th>Review</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $stores)
                                            <tr>
                                                <td>
                                                    <img src={{ env('IMAGE_URL') }}/uploads/{{ $stores->store_image }}
                                                        style="width:50px; height:50px;" />
                                                </td>
                                                @php
                                                    $rating = $stores->order_rate;
                                                    $stars = '';
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        $stars .= $i <= $rating ? '★' : '☆';
                                                    }
                                                @endphp
                                                <td>{{ $stores->store_name }}</td>
                                                <td> {{ $stars }}</td>
                                                <td><label class="badge badge-success"><i
                                                            class="fa-regular fa-pen-to-square"
                                                            style="color:white;"></i></label></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end earning and top stores -->

            <!-- start recent order and top driver list -->

            <div class="row gy-5 g-xl-8 mt-5 mb-5 d-flex ">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Orders</h3>
                            <a href=" {{ route('admin.orders.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>

                        @foreach ($recent_order as $OrderedItems)
                            <?php $items = json_decode($OrderedItems['items'], true); ?>
                        @endforeach
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($recent_order as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ $order['store']['store_name'] }}</td>
                                                <td></td>
                                                <td>{{ count($items) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Top Drivers</h4>
                            <a href=" {{ route('admin.drivers.index') }}">
                                <label class="mt-8"><i class="fa fa-solid fa-bars"
                                        style="font-size: 18px;color:#009EF7;cursor:pointer;"></i></label>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Driver</th>
                                            <th>Order Completed</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($driver_list as $driver)
                                            <tr>
                                                <td> <img src={{ env('IMAGE_URL') }}/uploads/{{ $driver->driver_image }}
                                                        style="width:50px; height:50px;" /></td>
                                                <td>{{ $driver->driver_name }}</td>
                                                <td>{{ $driver->order_status == 1 ? 'completed' : '' }}</td>
                                                <td><label class="badge badge-success"><i
                                                            class="fa-regular fa-pen-to-square"
                                                            style="color:white;"></i></label></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end recent order and top driver list -->

            <!--end::Col-->
        </div>
        <!--end::Post-->
    @endsection

    @push('scripts')
        <script>
            function dashboard() {
                $.ajax({
                        url: `{{ route('admin.dashboard-counts') }}`,
                        type: "get",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                    })
                    .done(function(response) {
                        console.log(response);
                        $('.new_users').text(response.data.new_users);
                        $('.total_clients').text(response.data.total_clients);
                        $('.yearly_sales_count').text(response.data.yearly_sales_count);

                        $('.total_vendors').text(response.data.total_vendors);

                        $('.total_purchase').text(response.data.total_purchase);

                        $('.total_unpaid_bill').text(response.data.total_unpaid_bill);
                        $('.total_unrecieved_bill').text(response.data.total_unrecieved_bill);
                        $('.total_unrecieved_amount').text((response.data.total_unrecieved_amount).toLocaleString());

                        $('.total_dept_balance').text((response.data.total_dept_balance).toLocaleString());
                        $('.total_asset').text(response.data.total_asset);
                    })
                    .fail(function() {
                        Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }
            dashboard();
        </script>
    @endpush
