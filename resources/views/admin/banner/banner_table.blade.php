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
    <div class="container-fluid">

        <div class="row mt-5 justify-content-center">
            <div class="col-md-3 col-sm-3 col-xl-3 col-lg-3">
                <input type="search" name="banner_title" class="form-control searchEmail p-4"
                    placeholder="Search for Banner Title" />
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-12 table-responsive text-center">
                <table class="table table-bordered data-table text-center table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Banner Image</th>
                            <th>Banner Title</th>
                            <th>Publish</th>
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
                url: "{{ route('admin.banners.index') }}",
                data: function(d) {
                    d.banner_title = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'banner_id',
                    name: 'banner_id'
                },
                {
                    data: 'banner_image',
                    name: 'banner_image',
                    render: function(data) {
                        return '<img src="{{ env('APP_URL') }}/uploads/' + data +
                            '" class="avatar" width="50" height="50"/>';
                    }
                },
                {
                    data: 'banner_title',
                    name: 'banner_title'
                },
                {
                    data: 'banner_publish',
                    name: 'publish'
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