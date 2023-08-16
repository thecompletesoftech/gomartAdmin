@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.storeview', [
            'name' => trans_choice('content.store', 2),
        ]),
    ])

    <div class="post d-flex ">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <div class="mt-5 mx-5">
                    <p style="float:right;" id="printButton"><i class="fa fa-download"
                            style="font-size:20px;cursor: pointer;"></i></p>
                </div>
                <hr />
                <p class="mx-20" style="font-size:20px;"> {{ $data['store']['store_name'] }}</p>
                <p class="mx-20" style="font-size:20px;"> {{ $data['store']['store_address'] }}</p>
                <p class="mx-20" style="font-size:15px;">Phone: {{ $data['store']['store_phone'] }}</p>

                <p class="mx-20">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>

                <p class="mx-20" style="font-size:15px;">Order Id: {{ $data->order_id }}</p>
                <p class="mx-20" style="font-size:15px;">Order Date: {{ $data->order_date }}</p>
                <p class="mx-20" style="font-size:15px;">Customer Name: {{ $data['user']['name'] }}</p>
                <p class="mx-20" style="font-size:15px;">Customer Phone: {{ $data['user']['phone'] }}</p>
                <p class="mx-20" style="font-size:15px;">Customer Address:</p>

                <p class="mx-20">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>

                @foreach ($order_item as $item)
                    <div class="mt-5 mx-20">
                        <div class="card" style="background-color:#F9F6EE;">
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Item Id</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Item Price</th>
                                            <th scope="col">Item Qty </th>
                                            <th scope="col">Item Photo</th>
                                            <th scope="col">Item Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th scope="row">{{ $item['item_id'] }}</th>
                                            <td>{{ $item['item_name'] }}</td>
                                            <td>{{ $item['item_price'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td></td>
                                            <td>{{ $item['item_price'] * $item['quantity'] }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                @endforeach

                <p class="mx-20 mt-5">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>

                <div class="row mx-20">
                    <div class="col-4">
                        <label>Items Price:</label><br />
                        <label>Addon Cost:</label><br />
                        <label>Subtotal:</label><br />
                        <label>Discount:</label><br />
                        <label>Special Discount:</label><br />
                        <label>VAT/TAX:</label><br />
                        <label>DM Tips:</label><br />
                        <label>Delivery Fee:</label><br />

                        <hr />

                        <label>Total:</label><br />

                    </div>

                    @php
                        $itemPrice = collect($order_item)->sum('item_price');
                        $Subtotal = collect($order_item)->sum('item_price');
                        $Discount = collect($order_item)->sum('dis_item_price');
                        $TotalPrice = $itemPrice + $Subtotal + $Discount;
                    @endphp

                    <div class="col-4">
                        <label>{{ $itemPrice }}</label><br />
                        <label></label><br />
                        <label>{{ $Subtotal }}</label><br />
                        <label>{{ $Discount }}</label><br />
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
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@push('scripts')
    <script type="text/javascript">
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>
@endpush