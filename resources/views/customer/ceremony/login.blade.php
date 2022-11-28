@extends('layouts.app')

@section('title', 'Add Ceremony')

@section('content')

<div class="row">
    <div class="col-lg-4 pr-0" >
        <div class="card mb-0" style="position: relative;transform:translateX(50%);left: 50%;top: 25%">
            <div class="card-body">

                <h3 class="text-center m-0">
                    <a href="index.html" class="logo logo-admin">
                        <img src="{{setting('image')}}" height="80px" alt="logo" class="my-3">
                    </a>
                </h3>

                <div class="px-2 mt-2">
                    <h4 class="text-muted font-size-18 mb-2 text-center">Please Select Ceremony </h4>

                    <form method="POST" action="{{ route('customer.addCeremony') }}">
                        @csrf
                        <input type="hidden" class="form-control" name="student_id" value="{{ old('student_id', isset($student_id) ? $student_id : '') }}" >

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="user" class="col-form-label pt-0">Choose Ceremony</label>
                                    <div class="">
                                        <select data-placeholder="Select Ceremony" class="select2 tail-select form-control ceremony_id" name="ceremony_id" required>
                                            <option disabled selected> -- Choose Ceremony -- </option>
                                            @foreach ($graduation->ceremony as $ceremony)
                                                <option value="{{ $ceremony->id }}" @if(old('ceremony_id') == $ceremony->id) selected @endif @if(isset($ceremony) && ($ceremony->ceremony_id == $ceremony->id)) selected @endif>{{ ucfirst($ceremony->title) }}</option>
                                            @endforeach
                                        </select>
                                        @error('ceremony_id')
                                            <span class="text-danger">{{ $errors->first('ceremony_id') }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Date</label>
                            <div class="input-group">
                                <input type="date" class="form-control ceremony_date" name="date" required value="" readonly>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Time</label>
                            <div class="input-group">
                                <input type="time" class="form-control ceremony_time" name="time" required value="" readonly>                                
                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group mb-0 row">
                            <div class="col-12 mt-2">
                                {{-- <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button> --}}
                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">
                                    Submit
                                    <i class="fas fa-sign-in-alt ml-1"></i>
                                </button>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="mt-4 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-9 p-0 vh-100  d-flex justify-content-center">
        <div class="accountbg d-flex align-items-center">
            <div class="account-title text-center text-white">
                <h4 class="mt-3 text-white">Customer Login</h4>
                <div class="border w-25 mx-auto border-warning"></div>
            </div>
        </div>
    </div> --}}
</div>

@endsection

@section('page-specific-scripts')
<script>
    $(document).ready( function () {
            $(document).on('change', '.ceremony_id', function(e) {
                e.preventDefault();
                let ceremony_id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('customer.fetchCeremony') }}',
                    data: {
                        ceremony_id: ceremony_id,
                    },
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = JSON.parse(response)
                        }
                        var tbody_html = "";
                        if (response.status) {
                            $('.ceremony_date').val(response.data.date);
                            $('.ceremony_time').val(response.data.time);
                        }
                    }

                })
            })
        })
</script>

@endsection



