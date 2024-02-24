@extends('admin.layouts.master')
@section('content')

    <!--Section-->
    <section>
        <div class="cover-image sptb ml-5 mr-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        {{-- @include('admin.pages.payments.includes.filter') --}}
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card mb-0 table-bordered">
                                    <div class="card-header border-0">
                                        <h4 class="card-title">پرداخت ها</h4>
                                        
                                        <div class="card-options">
                                            <a href="{{route('admin.invoice.index')}}" class="btn btn-primary mr-30" data-target="#adddoctors">ثبت پرداخت جدید</a>
                                        </div>
                                    </div>
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5">شناسه صورت حساب</th>
                                                        <th class="border-bottom-0 w-5 text-center">نام دکتر  </th>
                                                        <th class="border-bottom-0 w-5 text-center">موبایل دکتر </th>
                                                        <th class="border-bottom-0 w-5 text-center">مبلغ پرداخت شده</th>
                                                        <th class="border-bottom-0 w-5 text-center">نوع پرداخت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عکس رسید</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ سر رسید</th>
                                                        <th class="border-bottom-0 w-5 text-center">وضعیت</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($payments as $payment)
                                                    <tr>
                                                        <td class="text-center"><span>{{$payment->id}}</span></td>
                                                        <td class="text-center"><span><a href="{{route('admin.invoices.show',[$payment->invoice_id])}}">{{$payment->invoice_id}}</a></span></td>
                                                        <td class="text-center "><span>{{$payment->invoice->doctor->name}}</span></td>
                                                        <td class="text-center "><span>{{$payment->invoice->doctor->mobile}}</span></td>
                                                        <td class="text-center "><span>{{number_format($payment->amount)}}</span></td>
                                                        <td class="text-center "><span>{{$payment->getPayType()}}</span></td>
                                                        <td class="text-center "><span>@if(empty($payment->recipt)){{"ندارد"}}@else<img src="{{ Storage::url($payment->recipt) }}" style="width: 80px;height: 40px;" alt="Receipt Image">@endif</span></td>
                                                        @php
                                                        $vertaDate = verta($payment->due_date);
                                                        @endphp
                                                        <td class="text-center "><span>@if(empty($payment->due_date)){{"ندارد"}}@else{{$vertaDate->format('Y/n/j')}}@endif</span></td>
                                                        <td class="text-center">@include('includes.status',["status" => $payment->status])</td>
                                                        </span></td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="bg-warning action-btns1"
                                                                data-toggle="modal"
                                                                data-target="#store-menu-{{ $payment->id }}">
                                                                <i class="fe fe-edit text-white" data-toggle="tooltip" aria-hidden="true" data-placement="top" ></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                        @empty
                                                        <tr>
                                                            <td>
                                                                <span class="text-danger">هیچ داده ای یافت نشد</span>
                                                            </td>
                                                        </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{$payments->onEachSide(1)->links("vendor.pagination.bootstrap-4")}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    Copyright © 2024 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    @include('admin.pages.payments.includes.edit')
    @endsection
        @section('scripts')
            <script>
                $('#payment_date_show').MdPersianDateTimePicker({
                    targetDateSelector: '#payment_date',
                    targetTextSelector: '#payment_date_show',
                    englishNumber: false,
                    toDate:true,
                    enableTimePicker: false,
                    dateFormat: 'yyyy-MM-dd',
                    textFormat: 'yyyy-MM-dd',
                    groupId: 'rangeSelector1',
                });
            </script>
        @endsection