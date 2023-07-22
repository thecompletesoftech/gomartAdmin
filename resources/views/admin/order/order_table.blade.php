<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <div class="container">

        <div class="row mt-3">
            <div class="col-4" style="float:right;">
                <input type="search" name="item_name" class="form-control searchEmail"
                    placeholder="Search for Product Name" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 table-responsive text-center">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Order ID </th>
                            <th>Client </th>
                            <th>Date </th>
                            <th>Product Name </th>
                            <th>Amount </th>
                            <th>Order Type </th>
                            <th>Order Status </th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>
</body>
<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.orders.index') }}",
                data: function(d) {
                    d.item_name = $('.searchEmail').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'order_id',
                    name: 'order_id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'order_date',
                    name: 'order_date'
                },
                {
                    data: 'item_name',
                    name: 'item_name'
                },
                {
                    data: 'order_amount',
                    name: 'order_amount'
                },
                {
                    data: 'order_type',
                    name: 'order_type'
                },
                {
                    data: 'order_status',
                    name: 'order_status'
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });

        $(".searchEmail").keyup(function() {
            table.draw();
        });

    });
</script>

</html>
