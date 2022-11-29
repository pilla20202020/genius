<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Toastr-->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

    @yield('page-specific-styles')

</head>

<body>

    <div class="container mt-4">
        <div class="card ">
            @if (Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success mt-3 mb-3" id="alert_message">
                    {{ Illuminate\Support\Facades\Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card-header justify-content-center align-center">
                <h2 class="text-center">Simple QR Code</h2>
            </div>
            <div class="card-body justify-content-center align-center">
                {!! QrCode::size(300)->generate(route('customer.updateCheckIn', $order['order'])) !!}
            </div>
        </div>
    </div>

    <script src="{{ asset('js/toastr/toastr.js') }}"></script>
    <script>
        {!! Toastr::message() !!}
    </script>

    <script>
    

        setTimeout(() => {
            $('#alert_message').hide();
        }, 6000);

    </script>
</body>
</html>