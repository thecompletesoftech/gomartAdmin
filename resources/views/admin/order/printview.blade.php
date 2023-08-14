@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.print', [
            'name' => trans_choice('content.order', 2),
        ]),
    ])

    <div class="post d-flex ">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <div class="mt-5 mx-5">
                    <p style="float:right;" id="printButton"><i class="fa fa-download" style="font-size:20px;"></i></p>
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                @endforeach

                <p class="mx-20 mt-5">-----------------------------------------------------------</p>
                <p class="mx-20">--------</p>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

<script type="text/javascript">        
        document.getElementById('#printButton').addEventListener('click', function () {
            window.print();
        });
</script>