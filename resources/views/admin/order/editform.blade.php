<div class="card-body">

    <!--begin::Input group-->

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Amount</label>

        <div class="col-lg-4 fv-row">
            {!! Form::number('order_amount', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_amount', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Order Status</label>
        <div class="col-lg-4 fv-row">
            <select name="order_status" class="form-control form-control-lg form-control-solid">
                <option value="">Select Order Status</option>
                <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Complete</option>
                <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>Cancel</option>
            </select>
        </div>

    </div>

    <div class="row mb-6">

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Payment method</label>
        <div class="col-lg-4 fv-row">
            {!! Form::text('order_type', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_type', 1),
            ]) !!}
        </div>

        <label class="col-lg-2 col-form-label required fw-bold fs-6">Created Date</label>
        <div class="col-lg-4 fv-row">
            {!! Form::date('order_date', null, [
                'min' => 2,
                'max' => 6,
                'value' => 2,
                'class' => 'form-control form-control-lg form-control-solid',
                'placeholder' => trans_choice('content.order_date', 1),
            ]) !!}
        </div>

    </div>

    <div class="row mb-6 mt-2">

        <h1>Billing Details</h1>
        <div class="mx-1 mt-2">
            <label><b>Name:</b></label>&nbsp;{{ $user['user']['name'] }}<br />
            <label><b>Address:</b></label>&nbsp;{{ $user['user']['address'] }}<br />
            <label><b>Email Address:</b></label>&nbsp;{{ $user['user']['email'] }}<br />
            <label><b>Phone:</b></label>&nbsp;{{ $user['user']['phone'] }}<br />
        </div>

    </div>

    <div class="row mb-6">
        <h1>Store Details</h1>
        <div class="mx-1 mt-2">
            <label><b>Store Image:</b></label>&nbsp;<img
                src={{ env('IMAGE_URL') }}/uploads/{{ $user['store']['store_image'] }}
                style="width:50px; height:50px;" />
            <br />
            <br />
            <label><b>Store Name:</b></label>&nbsp;{{ $user['store']['store_name'] }}<br />
            <label><b>Phone:</b></label>&nbsp;{{ $user['store']['store_phone'] }}<br />
            <label><b>Address:</b></label>&nbsp;{{ $user['store']['store_address'] }}<br />
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

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EditOrderRequest', 'form') !!}
@endpush