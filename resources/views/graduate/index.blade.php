@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Graduate')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Graduate</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction btn" href="{{ route('graduate.create') }}">
                        <i class="md md-add"></i>
                        Add
                    </a>

                    <a class="btn btn-success ink-reaction btn" href="{{ route('graduate.importGraduate') }}">
                        <i class="md md-add"></i>
                        Import Graduate
                    </a>

                    <a class="btn btn-warning ink-reaction btn" href="{{ route('graduate.sampleDownload') }}">
                        <i class="md md-add"></i>
                        Smaple Download
                    </a>
                </div>
                @if(isset($status)) 
                <input name="filter" value="{{$status}}" class="select2 tail-select form-control filter" type="hidden">
                @endif
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url":  "{{ route('graduate.data') }}",
                    data: function (d) {
                        d.filter = $('.filter').val();
                    }
                }, 
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print',
                //     // exportOptions: {
                //     //     columns: 'th:not(:last-child)'
                //     // }
                // ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Export Search Results',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                ],
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: false, searchable: false },
                    { "data": "student_id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "status" },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [ [0, 'desc'] ]
            });
        } );
    </script>
@endsection


