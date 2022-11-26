@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="form-group">
                                <input type="text" title="title" class="form-control" required
                                       value="{{ old('title', isset($ceremony->title) ? $ceremony->title : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('title') }}</span>
                                <label for="title">title</label>
                            </div> --}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="user" class="col-form-label pt-0">Choose Graduation</label>
                                        <div class="">
                                            <select data-placeholder="Select Graduation" class="select2 tail-select  form-control" name="graduation_id" required>
                                                @foreach ($graduations as $graduation)
                                                    <option value="{{ $graduation->id }}" @if(old('graduation_id') == $graduation->id) selected @endif @if(isset($ceremony) && ($ceremony->graduation_id == $graduation->id)) selected @endif>{{ ucfirst($graduation->title) }}</option>
                                                @endforeach
                                            </select>
                                            @error('graduation_id')
                                                <span class="text-danger">{{ $errors->first('graduation_id') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="title" class="col-form-label pt-0">Title</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="title" value="{{ old('title', isset($ceremony->title) ? $ceremony->title : '') }}" placeholder="Enter Title">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="date" class="col-form-label pt-0">Time</label>
                                <div class="">
                                    <input class="form-control" type="time" name="time"
                                    value="{{ old('time', isset($ceremony->time) ? $ceremony->time : '') }}" placeholder="Enter Time">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label pt-0">Choose Status</label>
                                <select name="status" id="" class="select2 tail-select form-control" id="">
                                    <option value="" disabled selected> -- Select Status -- </option>
                                    <option value="active" @if(isset($ceremony) && $ceremony->status == "active") selected @endif>Active</option>
                                    <option value="finished" @if(isset($ceremony) && $ceremony->status == "finished") selected @endif>Finished</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" >
            <div class="card-body">
                
                <div class="row mt-2 justify-content-center">
                    <div class="form-group">
                        <div>
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('ceremony.index') }}">
                                <i class="md md-arrow-back"></i>
                                Back
                            </a>
                            <input type="submit" title="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
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

        $(document).ready(function() {
            $('.select2').select2();
        });

        $('.lfm').filemanager('file');
    </script>
@endsection
