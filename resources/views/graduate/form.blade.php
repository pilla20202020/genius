@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="student_id" class="col-form-label pt-0">Student ID </label>
                                <div class="">
                                    <input class="form-control" type="text" required name="student_id" value="{{ old('student_id', isset($graduate->student_id) ? $graduate->student_id : '') }}" placeholder="Enter Student ID">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="first_name" class="col-form-label pt-0">First Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="first_name" value="{{ old('first_name', isset($graduate->first_name) ? $graduate->first_name : '') }}" placeholder="Enter First Name">
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="last_name" class="col-form-label pt-0">Last Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="last_name" value="{{ old('last_name', isset($graduate->last_name) ? $graduate->last_name : '') }}" placeholder="Enter Last Name">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="email" class="col-form-label pt-0">Email</label>
                                <div class="">
                                    <input class="form-control" type="email" name="email"
                                    value="{{ old('email', isset($graduate->email) ? $graduate->email : '') }}" placeholder="Enter Email">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="mobile" class="col-form-label pt-0">Mobile</label>
                                <div class="">
                                    <input class="form-control" type="number" name="mobile"
                                        value="{{ old('mobile', isset($graduate->mobile) ? $graduate->mobile : '') }}" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label pt-0">Choose Status</label>
                                <select name="status" id="" class="select2 tail-select form-control" id="">
                                    <option value="" disabled selected> -- Select Status -- </option>
                                    <option value="eligible" @if(isset($graduate) && $graduate->status == "eligible") selected @endif>Eligible</option>
                                    <option value="register" @if(isset($graduate) && $graduate->status == "register") selected @endif>Register</option>
                                    <option value="incomplete" @if(isset($graduate) && $graduate->status == "incomplete") selected @endif>Incomplete</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @enderror
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


@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        $('.lfm').filemanager('file');
    </script>
@endsection
