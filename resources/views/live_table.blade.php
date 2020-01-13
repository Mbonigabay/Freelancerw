<!DOCTYPE html>
<html>
<head>
    <title>Live Table Insert Update Delete in Laravel using Ajax jQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>

<table id="table_id" class="display ">
    <thead>
    <tr>
        <th>#</th>
        <th>Freelance name</th>
        <th>Freelance email</th>
        <th>Freelance address</th>
    </tr>
    </thead>
    <tbody>

    </tbody>

</table>
{{ csrf_field() }}
</body>
</html>

<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
