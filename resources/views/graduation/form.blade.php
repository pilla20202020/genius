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
                                       value="{{ old('title', isset($graduation->title) ? $graduation->title : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('title') }}</span>
                                <label for="title">title</label>
                            </div> --}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="user" class="col-form-label pt-0">Choose Instituion</label>
                                        <div class="">
                                            <select data-placeholder="Select Instituion" class="select2 tail-select  form-control" name="institution_id" required>
                                                @foreach ($institutions as $institution)
                                                    <option value="{{ $institution->id }}" @if(old('institution_id') == $institution->id) selected @endif @if(isset($graduation) && ($graduation->institution_id == $institution->id)) selected @endif>{{ ucfirst($institution->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('institution_id')
                                                <span class="text-danger">{{ $errors->first('institution_id') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="title" class="col-form-label pt-0">Title</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="title" value="{{ old('title', isset($graduation->title) ? $graduation->title : '') }}" placeholder="Enter Title">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="date" class="col-form-label pt-0">Date</label>
                                <div class="">
                                    <input class="form-control" type="date" name="date"
                                    value="{{ old('date', isset($graduation->date) ? $graduation->date : '') }}" placeholder="Enter Date">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label pt-0">Choose Status</label>
                                <select name="status" id="" class="select2 tail-select form-control" id="">
                                    <option value="" disabled selected> -- Select Status -- </option>
                                    <option value="active" @if(isset($graduation) && $graduation->status == "active") selected @endif>Active</option>
                                    <option value="finished" @if(isset($graduation) && $graduation->status == "finished") selected @endif>Finished</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="description" class="col-form-label pt-0">Description </label>
                                <div class="">
                                    <textarea class="form-control" name="description">
                                    {{ old('description', isset($graduation->description) ? $graduation->description : '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label">Image</label><br>
                            @if(isset($graduation) && $graduation->image)
                                <img id="holder" style="margin-top:5px;max-height:150px;" class="img img-fluid mb-2" src="{{$graduation->image}}"><br>
                            @endif
                            <div class="d-flex">
                                
                                <input id="thumbnail" class="form-control" type="text" name="image" readonly value="{{ old('image', isset($graduation->image) ? $graduation->image : '') }}">
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
                
                <div class="row mt-2 justify-content-center">
                    <div class="form-group">
                        <div>
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('graduation.index') }}">
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
