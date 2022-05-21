@push('head')
    @if(config('discount.public.bootstrap'))
        <link rel="stylesheet" href="{{asset('vendor/discount/css/bootstrap.min.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-default.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-dark.css')}}">
@endpush
<link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/discount/css/persianDatepicker-dark.css')}}">
<div class="container-fluid" style="direction: rtl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">کد تخفیف ها</h4>
                    <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg" style="position: absolute;left:44px;top: 16px;">کد تخفیف جدید</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-center">کد تخفیف</th>
                            <th scope="col" class="text-center">تعداد کد تخفیف</th>
                            <th scope="col" class="text-center">مبلغ کد</th>
                            <th scope="col" class="text-center">استفاده شده</th>
                            <th scope="col" class="text-center">تاریخ شروع</th>
                            <th scope="col" class="text-center">تاریخ پایان</th>
                            <th scope="col" class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <th scope="row">{{$discount->id}}</th>
                                <td class="text-primary text-center">{{$discount->code}}</td>
                                <td class="text-warning text-center">{{$discount->quantity}}</td>
                                <td class="text-center">{{number_format((int)$discount->price)}} تومان </td>
                                <td class="text-danger text-center">{{$discount->discunt_used}}</td>
                                <td class="text-center">{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($discount->start_date))}}</td>
                                <td class="text-center">{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strftime($discount->end_date))}}</td>
                                <td class="text-center">
                                    @if($discount->discunt_used !== 0)
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".users-discount-{{$discount->id}}">کاربران استفاده کردن</button>
                                    @else
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".users-discount-{{$discount->id}}" disabled>کاربران استفاده کردن</button>
                                    @endif
                                    <div class="modal fade users-discount-{{$discount->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="myLargeModalLabel1">کد تخفیف جدید</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">نام و نام خوادگی</th>
                                                            <th scope="col">تاریخ استفاده</th>
                                                            <th scope="col">بخش استفاده</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($discount->historyDiscount as $history)
                                                            <tr>
                                                                <th scope="row">{{$history->id}}</th>
                                                                <td>{{$history->user->name}}</td>
                                                                <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strftime($history->created_at))}}</td>
                                                                <td>{{$history->section_used}}</td>
                                                                <td><a href="{{asset('') . config('discount.url.discounts-user') . '/' . $history->user->id}}" class="btn btn-primary"> همه کد تخفیف های استفاده کرده </a></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                    <a href="{{asset('') . config('discount.url.users_discount') . '/' .$discount->id}}" class="btn btn-primary">نمایش همه کاربران</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".edit-{{$discount->id}}">ویرایش</button>
                                    @if($discount->approved)
                                        <button type="button" class="btn btn-warning" onclick="statusDiscount({{$discount->id}}, 0)">غیر فعال</button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="statusDiscount({{$discount->id}}, 1)">فعال</button>
                                    @endif
                                    <button type="button" class="btn btn-danger" onclick="removeDiscount({{$discount->id}})">حذف</button>
                                </td>
                            </tr>
                            <div class="modal fade edit-{{$discount->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="myLargeModalLabel">کد تخفیف جدید</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form autocomplete="off" id="edit-discount" method="POST" action="?type=edit&discountId=1">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label>کد تخفیف</label>
                                                        <button type="button" class="btn btn-primary btn-sm"  onclick="createCodeDiscount('edit-code')">ایجاد کد</button>
                                                        <input type="text" name="code" id="edit-code" value="{{$discount->code}}" class="form-control" placeholder="کد تخفیف" onkeyup="success(this)">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>تعداد استفاده</label>
                                                        <input type="text" name="quantity" value="{{$discount->quantity}}" id="edit-quantity" class="form-control" placeholder="تعداد استفاده" onkeyup="success(this)">
                                                    </div>
                                                    <div class="col-12">
                                                        <label>مبلغ تخفیف</label>
                                                        <input type="text" name="price" id="edit-price" value="{{number_format((int)$discount->price)}}" class="form-control" placeholder="مبلغ تخفیف" onkeyup="success(this)">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>تاریخ شروع</label>
                                                        <input type="text" class="form-control edit-1-start_date" value="{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strftime($discount->start_date))}}" placeholder="تاریخ شروع" onclick="datepicker(['.edit-1-start_date', '#edit-1-start_date'])">
                                                        <input type="hidden" name="end_date" id="edit-1-start_date">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>تاریخ پایان</label>
                                                        <input type="text" class="form-control edit-1-end_date" value="{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strftime($discount->end_date))}}" placeholder="تاریخ پایان" onclick="datepicker(['.edit-1-end_date', '#edit-1-end_date'])">
                                                        <input type="hidden" name="end_date" id="edit-1-end_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">ذخیره</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    {{$discounts->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">کد تخفیف جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form autocomplete="off" id="insert_discount" method="POST" action="create?type=insert">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label>کد تخفیف</label>
                                <button type="button" class="btn btn-primary btn-sm"  onclick="createCodeDiscount('code')">ایجاد کد</button>
                                <input type="text" name="code" id="code" class="form-control" placeholder="کد تخفیف" onkeyup="success(this)">
                            </div>
                            <div class="col-6">
                                <label>تعداد استفاده</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="تعداد استفاده" onkeyup="success(this)">
                            </div>
                            <div class="col-12">
                                <label>مبلغ تخفیف</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="مبلغ تخفیف" onkeyup="success(this)">
                            </div>
                            <div class="col-6">
                                <label>تاریخ شروع</label>
                                <input type="text" class="form-control start_date" placeholder="تاریخ شروع"  onclick="datepicker(['.start_date', '#start_date'])">
                                <input type="hidden" name="start_date" id="start_date">
                            </div>
                            <div class="col-6">
                                <label>تاریخ پایان</label>
                                <input type="text" class="form-control end_date" placeholder="تاریخ پایان" onclick="datepicker(['.end_date', '#end_date'])">
                                <input type="hidden" name="end_date" id="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('footer')
    @if(config('discount.public.bootstrap'))
        <script src="{{asset('vendor/discount/js/jquery-3.2.1.slim.min.js')}}"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="{{asset('vendor/discount/js/sweetalert2@11.js')}}"></script>
        <script src="{{asset('vendor/discount/js/bootstrap.min.js')}}"></script>
    @endif
    <script src="{{asset('vendor/discount/js/persianDatepicker.min.js')}}"></script>
    <script src="{{asset('vendor/discount/js/discount.js')}}"></script>
@endpush
