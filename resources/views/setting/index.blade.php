@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('title', 'Setting')

@section('content')
    <section>
        {{ Form::open(['route'=>'setting.update','class'=>'form form-validate','method'=>'PUT','files'=>true,'novalidate']) }}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-head d-flex p-2">
                        <header>General Settings</header>
                        <div class="tools ml-auto">
                            <input type="submit" class="btn btn-primary" value="Save All">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-head">
                                    <header class="p-2">General</header>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="tab-pane active" id="first2">

                                        <div class="form-group">
                                            {{ Form::label('setting[project_name]', 'Project Title') }}
                                            {{ Form::text('setting[project_name]', old('setting.project_name') ?: setting('project_name'), ['class'=>'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('setting[description]', 'Site description') }}
                                            {{ Form::text('setting[description]', old('setting.description') ?: setting('description'), ['class'=>'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('setting[address]', 'Address') }}
                                            {{ Form::textarea('setting[address]', old('setting.address') ?: setting('address'), ['class'=>'form-control','rows'=>2,]) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('setting[google_map]', 'Google Map Link') }}
                                            {{ Form::textarea('setting[google_map]', old('setting.google_map') ?: setting('google_map'), ['class'=>'form-control','rows'=>2]) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('setting[vat]', 'VAT') }}
                                            {{ Form::text('setting[vat]', old('setting.vat') ?: setting('vat'), ['class'=>'form-control']) }}
                                        </div>


                                        @if(setting('image'))
                                            <img id="holder" style="margin-top:15px;max-height:300px;" class="img img-fluid" src="{{setting('image')}}">
                                        @endif
                                        <input id="thumbnail" class="form-control" type="text" name="setting[image]" readonly>
                                        <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-icon icon-left btn-primary mt-2">
                                            <i class="fa fa-upload"></i> &nbsp;Choose
                                        </button>




                                        {{-- <div class="form-group" id="imageupload">
                                            <label class="text-default-light">Banner Image</label>
                                            @if (isset($setting) && $setting->banner)
                                                <input type="file" name="banner" class="dropify"
                                                    data-default-file="{{ asset($setting->main_image) }}" />
                                            @else
                                                <input type="file" name="banner" class="dropify" />
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-head">
                                    <header class="p-2">SMS</header>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="tab-pane active" id="first3">
                                        <div class="form-group">
                                            {{ Form::label('setting[sms_api]', 'SMS API') }}
                                            {{ Form::text('setting[sms_api]', old('setting.sms_api') ?: setting('sms_api'), ['class'=>'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('setting[sms_token]', 'SMS TOKEN') }}
                                            {{ Form::text('setting[sms_token]', old('setting.sms_token') ?: setting('sms_token'), ['class'=>'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('setting[sms_from]', 'SMS From') }}
                                            {{ Form::text('setting[sms_from]', old('setting.sms_from') ?: setting('sms_from'), ['class'=>'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-head">
                                    <header class="p-2">Social Links</header>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ Form::label('setting[facebook]', 'Facebook') }}
                                        {{ Form::textarea('setting[facebook]', old('setting.facebook') ?: setting('facebook'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[instagram]', 'Instagram') }}
                                        {{ Form::textarea('setting[instagram]', old('setting.instagram') ?: setting('instagram'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[twitter]', 'Twitter') }}
                                        {{ Form::textarea('setting[twitter]', old('setting.twitter') ?: setting('twitter'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[youtube]', 'Youtube') }}
                                        {{ Form::textarea('setting[youtube]', old('setting.youtube') ?: setting('youtube'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[linkedin]', 'LinkedIn') }}
                                        {{ Form::textarea('setting[linkedin]', old('setting.linkedin') ?: setting('linkedin'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-head">
                                    <header>Counter</header>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ Form::label('setting[total_location]', 'Total Locations') }}
                                        {{ Form::textarea('setting[total_location]', old('setting.total_location') ?: setting('total_location'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[popular_destination]', 'Popular Destinations') }}
                                        {{ Form::textarea('setting[popular_destination]', old('setting.popular_destination') ?: setting('popular_destination'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[top_listing]', 'Top Listings') }}
                                        {{ Form::textarea('setting[top_listing]', old('setting.top_listing') ?: setting('top_listing'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[customers]', 'Total Customers') }}
                                        {{ Form::textarea('setting[customers]', old('setting.customers') ?: setting('customers'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-head">
                                    <header>About Us</header>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ Form::label('setting[owner_says]', 'Owner Says') }}
                                        {{ Form::textarea('setting[owner_says]', old('setting.owner_says') ?: setting('owner_says'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[main_image]', 'Main Image') }}
                                        {{ Form::file('setting[main_image]', old('setting.main_image') ?: setting('main_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[slider1_image]', 'Slider1 Image') }}
                                        {{ Form::file('setting[slider1_image]', old('setting.slider1_image') ?: setting('slider1_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[slider1_image]', 'Slider2 Image') }}
                                        {{ Form::file('setting[slider2_image]', old('setting.slider2_image') ?: setting('slider2_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[slider1_image]', 'Slider3 Image') }}
                                        {{ Form::file('setting[slider3_image]', old('setting.slider3_image') ?: setting('slider3_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[slider1_image]', 'Slider4 Image') }}
                                        {{ Form::file('setting[slider4_image]', old('setting.slider4_image') ?: setting('slider4_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('setting[slider1_image]', 'Slider5 Image') }}
                                        {{ Form::file('setting[slider5_image]', old('setting.slider5_image') ?: setting('slider5_image'), ['class'=>'form-control','rows'=>2]) }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        </div>
        {{ Form::close() }}
    </section>
@stop

@section('page-specific-scripts')

    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        $('#lfm').filemanager('image');

    </script>
@endsection


