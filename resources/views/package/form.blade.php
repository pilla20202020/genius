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
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($package->name) ? $package->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Title</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="title" value="{{ old('title', isset($package->title) ? $package->title : '') }}" placeholder="Enter Package Title">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="specialization" class="col-form-label pt-0">price</label>
                                <div class="">
                                    <input class="form-control" type="text" name="price"
                                    value="{{ old('price', isset($package->price) ? $package->price : '') }}" placeholder="Enter Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="description" class="col-form-label pt-0">Description </label>
                                <div class="">
                                    <textarea class="form-control" name="description">
                                    {{ old('description', isset($package->description) ? $package->description : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label pt-0">Choose Package Type</label>
                                <select name="type" id="" class="select2 tail-select form-control" id="">
                                    <option value="" disabled selected> -- Select Package Type -- </option>
                                    <option value="main" @if(isset($package) && $package->type == "main") selected @endif>Main Package</option>
                                    <option value="other" @if(isset($package) && $package->type == "other") selected @endif>Other</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label">Image</label><br>
                            @if(isset($package) && $package->image)
                                <img id="holder" style="margin-top:5px;max-height:150px;" class="img img-fluid mb-2" src="{{$package->image}}"><br>
                            @endif
                            <div class="d-flex">
                                
                                <input id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ old('image', isset($package->image) ? $package->image : '') }}">
                                <button id="lfm" data-input="thumbnail" data-preview="holder" class="lfm btn btn-icon icon-left btn-primary ml-2 d-flex">
                                    <i class="fa fa-upload"></i> &nbsp;Choose
                                </button>
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group d-flex">
                            <span class="pl-1">Status</span>
                            <input type="checkbox" id="switch1" switch="none" name="status" {{ old('status', isset($package->status) ? $package->status : '')=='active' ? 'checked':'' }}/>
                            <label for="switch1" class="ml-auto" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-2 justify-content-center">
                    <div class="form-group">
                        <div>
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('package.index') }}">
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
