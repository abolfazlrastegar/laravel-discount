@section('title', 'users discount')
@extends(config('discount.layouts'))
@section('content')
    <div class="container-fluid" style="direction: rtl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-primary"> لیست کابران استفاده کردن از کد تخفیف <span class="text-warning">{{$users_discount[0]->discount->code}}</span></h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">نام و نام خانوادگی</th>
                                <th scope="col" class="text-center">درصد تخفیف </th>
                                <th scope="col" class="text-center">مبلغ </th>
                                <th scope="col" class="text-center">بخش استفاده شده</th>
                                <th scope="col" class="text-center">تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users_discount as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td class="text-warning text-center">{{$item->user->name }} {{$item->user->family }}</td>
                                    <td class="text-danger text-center">%{{$item->discount->percent}}</td>
                                    <td class="text-center">{{number_format((int)$item->discount->price)}} تومان </td>
                                    <td class="text-danger text-center">{{$item->section_used}}</td>
                                    <td class="text-center">{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users_discount->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
