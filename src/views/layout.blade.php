@push('head')
    @if(config('discount.file.display.bootstrap-css'))
        <link rel="stylesheet" href="{{asset('vendor/discount/css/bootstrap.min.css')}}">
    @endif
    @if(config('discount.file.display.persianDatepicker-default'))
        <link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-default.css')}}">
    @endif
    @if(config('discount.file.display.persianDatepicker-dark'))
        <link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-dark.css')}}">
    @endif
@endpush

@yield('content_discount')

@push('footer')
    @if(config('discount.file.display.jquery'))
        <script src="{{asset('vendor/discount/js/jquery-3.2.1.slim.min.js')}}"></script>
    @endif
    @if(config('discount.file.display.ajax'))
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    @endif
    @if(config('discount.file.display.bootstrap-js'))
        <script src="{{asset('vendor/discount/js/bootstrap.min.js')}}"></script>
    @endif
    @if(config('discount.file.display.persianDatepicker-js'))
        <script src="{{asset('vendor/discount/js/persianDatepicker.min.js')}}"></script>
    @endif
    @if(config('discount.file.display.sweetalert2'))
        <script src="{{asset('vendor/discount/js/sweetalert2@11.js')}}"></script>
    @endif
    <script src="{{asset('vendor/discount/js/discount.js')}}"></script>
@endpush
