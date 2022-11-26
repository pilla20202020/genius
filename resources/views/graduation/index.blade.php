@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Graduation')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Graduation</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction btn-sm" href="{{ route('graduation.create') }}">
                        <i class="md md-add"></i>
                        Add
                    </a>
                </div>
                
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Institution</th>
                            <th>Title</th>
                            <th>Date</th>
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

    {{-- Add Ceremony Time --}}
    <div class="modal fade add_ceremonytime" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Add Ceremony Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('graduation.addCeremonyTime')}}" method="POST"
                        class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="graduation_id" value="" name="graduation_id"
                            id="">
                        <div class="row justify-content-center">

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Time</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="Name">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="" selected disabled >Select Status</option>
                                    <option value="active">Active </option>
                                    <option value="finished">Finished </option>
                                </select>
                                <span class="text-danger">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks</label>
                                <textarea name="remarks" class="form-control" ></textarea>
                            </div>

                            


                
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light"
                                        value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <h6>List Of Ceremony</h6>
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="ceremonylist">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
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
                "ajax": '{{ route('graduation.data') }}',
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
                    { "data": "institution" },
                    { "data": "title" },
                    { "data": "date" },
                    { "data": "status" },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [ [0, 'desc'] ]
            });
        } );

        $(document).ready( function () {
            $(document).on('click', '.btn-action', function(e) {
                e.preventDefault();
                let graduation_id = $(this).data('id');
                $(".graduation_id").val(graduation_id);
                $.ajax({
                    type: 'get',
                    url: '{{ route('graduation.viewCeremony') }}',
                    data: {
                        graduation_id: graduation_id,
                    },
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = JSON.parse(response)
                        }
                        var tbody_html = "";
                        if (response.status) {
                            $.each(response.data, function(key, ceremony) {
                                key = key + 1;
                                tbody_html += "<tr>";
                                tbody_html += "<td>" + key + "</td>";
                                tbody_html += "<td>" + ceremony.title + "</td>";
                                tbody_html += "<td>" + ceremony.time + "</td>";
                                tbody_html += "<td>" + ceremony.status + "</td>";
                                tbody_html += "</tr>";
                            });
                            $('#ceremonylist').html(tbody_html);
                            $('.add_ceremonytime').modal('show');
                        }
                    }

                })
            })
        })
    </script>
@endsection


