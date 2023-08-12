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
                <input type="search" name="notification_subject" class="form-control searchEmail"
                    placeholder="Search for Notification Subject" />
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-12 table-responsive text-center">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
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
                url: "{{ route('admin.notifications.index') }}",
                data: function(d) {
                    d.notification_subject = $('.searchEmail').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'notification_id',
                    name: 'notification_id'
                },
                {
                    data: 'notification_subject',
                    name: 'notification_subject'
                },
                {
                    data: 'notification_message',
                    name: 'notification_message'
                },
                {
                    data: 'notification_date',
                    name: 'notification_date'
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