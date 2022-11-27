@extends('layouts.admin.admin')

@section('title', 'Import Graduates')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                
            </div>
            <form class="form form-validate floating-label" action="{{route('graduate.storeImportCustomer')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head row p-3">
                                    <header class="ml-3 mt-2">Import Graduate</header>
                                    <div class="tools ml-auto">
                                        <a class="btn btn-warning ink-reaction ml-3" href="{{ route('graduate.sampleDownload') }}">
                                            <i class="md md-add"></i>
                                            Smaple Download
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="student_id" class="col-form-label pt-0">Import Excel Graduate Data (Note: You can download sample From Sample Download and fill up the data.)</label>
                                                <div class="">
                                                    <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mt-2 justify-content-center">
                                        <div class="form-group">
                                            <div>
                                                <a class="btn btn-light waves-effect ml-1" href="{{ route('graduate.index') }}">
                                                    <i class="md md-arrow-back"></i>
                                                    Back
                                                </a>
                                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

