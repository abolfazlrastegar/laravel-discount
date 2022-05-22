@section('title', 'users discount')
@extends(config('discount.layouts'))
@section('content')
@extends('discount::layout')
@section('content_discount')
    <div class="container-fluid" style="direction: rtl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">لیست کابران استفاده کردن از کد تخفیف</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">نام و نام خانوادگی</th>
                                <th scope="col" class="text-center">کد تخفیف</th>
                                <th scope="col" class="text-center">مبلغ کد</th>
                                <th scope="col" class="text-center">بخش استفاده شده</th>
                                <th scope="col" class="text-center">تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discount_user as $discount)
                                <tr>
                                    <th scope="row">{{$discount->id}}</th>
                                    <td class="text-warning text-center">{{$discount->user->name }} {{$discount->user->family }}</td>
                                    <td class="text-primary text-center">{{$discount->discount->code}}</td>
                                    <td class="text-center">{{number_format((int)$discount->discount->price)}} تومان </td>
                                    <td class="text-danger text-center">{{$discount->section_used}}</td>
                                    <td class="text-center">{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($discount->created_at))}}</td>
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
                        {{$discount_user->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
