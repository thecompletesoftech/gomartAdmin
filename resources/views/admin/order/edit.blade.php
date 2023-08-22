@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.edit', ['name' => trans_choice('content.order', 1)]),
    ])
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">

        <!--begin::Container-->
        <div id="kt_content_container" class="container">

            <div class="row mb-6 mt-2">
                <div class="col-md-6">
                    <div class="mx-1 mt-2">
                        <h6>Billing Details</h6>
                        <hr />
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-2 fw-bold">{{ $user['user']['name'] }}<br /></div>
                                <div>{{ $user['user']['address'] }}<br /></div>
                                <div><b class="fs-2 fw-bold">Email Address:</b>
                                    <label class="fs-3">{{ $user['user']['email'] }}</label>
                                </div>
                                <div><b class="fs-2 fw-bold">Phone:</b>
                                    <label class="fs-3">{{ $user['user']['phone'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mx-1 mt-2">
                        <h6>Store Details</h6>
                        <hr />
                        <div class="card">
                            <div class="card-body">
                                <div class="mx-1 mt-1">
                                    <img
                                        src={{ env('IMAGE_URL') }}/uploads/{{ $user['store']['store_image'] }}
                                        style="width:50px; height:50px; border-radius:50px;" />
                                    
                                    <div><b>Store Name:</b></div>&nbsp;{{ $user['store']['store_name'] }}<br />
                                    <div><b>Phone:</b></div>&nbsp;{{ $user['store']['store_phone'] }}<br />
                                    <div><b>Address:</b></div>&nbsp;{{ $user['store']['store_address'] }}<br />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


            <div class="row mt-5">

                <h1>Item Details</h1>
                <br />
                <br />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ItemId</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Image</th>
                                <th>Item Discount</th>
                                <th>Item Quantity</th>
                                <th>Item Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderitem as $item)
                                <tr>
                                    <td>{{ $item->item_id }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->item_price }}</td>
                                    <td>
                                        <img src={{ env('IMAGE_URL') }}/uploads/{{ $item->item_image }}
                                            style="width:50px; height:50px;" />
                                    </td>
                                    <td>{{ $item->dis_item_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->quantity * $item->item_price }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row mt-5">
                <div class="col-4">
                    <label>Discount:</label><br />
                    <label>Subtotal:</label><br />
                    <label>Special Discount:</label><br />
                    <label>TAX:</label><br />
                    <label>Delivery Charge:</label><br />
                    <label>Tip Amount:</label><br />
                    <hr />
                    <label>Total Amount:</label><br />
                </div>

                @php
                    $itemPrice = collect($orderitem)->sum('item_price');
                    $subTotal = collect($orderitem)->sum('item_price');
                    $Discount = collect($orderitem)->sum('dis_item_price');
                    $TotalPrice = $itemPrice + $Discount;
                @endphp

                <div class="col-4">
                    <label>{{ $Discount }}</label><br />
                    <label></label>{{ $subTotal }}<br />
                    <label></label><br />
                    <label></label><br />
                    <label></label><br />
                    <label></label><br />
                    <hr />
                    <label>{{ $TotalPrice }}</label><br />
                    <br />
                    <br />
                    <br />
                </div>
            </div>

            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body">

                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            {!! Form::model($order, [
                                'method' => 'PATCH',
                                'route' => ['admin.orders.update', $order->order_id],
                                'class' => 'form mb-15',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->order_id }}">

                            @include('admin.order.editform')

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('admin.orders.index') }}"
                                    class="btn btn-light btn-active-light-primary me-2 text-black">{{ __('content.back_title') }}</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save
                                    Changes</button>
                            </div>
                            <!--end::Actions-->
                            {!! Form::close() !!}
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
