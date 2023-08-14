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
                                            {{ trans_choice('content.dashboard_cards.total_earning', 1) }}
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

            <div class="row gy-3 g-xl-8">
                <!--begin::Col-->
                <div class="col-12">

                    <div class="card">
                        <div class="card-body p-0 ">
                            <!--begin::Stats-->
                            <div class="card-p position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">First</th>
                                                            <th scope="col">Last</th>
                                                            <th scope="col">Handle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>Larry</td>
                                                            <td>the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end-->
        </div>
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
