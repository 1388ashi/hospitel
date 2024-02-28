@extends('admin.layouts.master')
@section('content')
<div class="row mx-5 my-4">
    <div class="col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                <h2 class="text-muted font-weight-bold">صورت حساب دکتر{{$invoice->doctor->name}}</h2>
                <div class="">
                <div class="d-flex" style="justify-content: space-between">
                    <h4 class=" font-weight-bold">توضیحات</h4>
                        @php
                        $vertaDate = verta($invoice->created_at);
                        @endphp
                        <ul class="d-md-flex" style="justify-content: left;align-items: flex-start;padding:0px;">
                            <li class=""  data-placement="top" data-toggle="tooltip" title="تاریخ ایجاد صورت حساب">
                                <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                            </li>
                        </ul>
                </div>
                    <ul class="list-style-disc">
                        <li>
                            @if ($invoice->description)
                            {{$invoice->description}}
                            @else
                            توضیحات ندارد
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="dropdown-divider"></div>
                <div class="row pt-4">
                    <div class="col-lg-6 ">
                        <p class="h5 font-weight-bold">Bill From</p>
                        <address>
                            Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ltd@example.com
                        </address>
                    </div>
                    <div class="col-lg-6 text-left">
                        <p class="h5 font-weight-bold">Bill To</p>
                        <address>
                            Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ctr@example.com
                        </address>
                    </div>
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover text-nowrap">
                        <tr class=" ">
                            <th class="text-center " style="width: 1%"></th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnty</th>
                            <th class="text-left" style="width: 1%">Unit Price</th>
                            <th class="text-left" style="width: 1%">Amount</th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="font-weight-semibold mb-1">Logo Creation</p>
                                <div class="text-muted">Logo and business cards design</div>
                            </td>
                            <td class="text-center">2</td>
                            <td class="text-left">$60.00</td>
                            <td class="text-left">$120.00</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <p class="font-weight-semibold mb-1">Online Store Design &amp; Development</p>
                                <div class="text-muted">Design/Development for all popular modern browsers</div>
                            </td>
                            <td class="text-center">3</td>
                            <td class="text-left">$80.00</td>
                            <td class="text-left">$240.00</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>
                                <p class="font-weight-semibold mb-1">App Design</p>
                                <div class="text-muted">Promotional mobile application</div>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-left">$40.00</td>
                            <td class="text-left">$40.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-semibold text-left">Subtotal</td>
                            <td class="text-left">$400.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-semibold text-left">Vat Rate</td>
                            <td class="text-left">20%</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-semibold text-left">Vat Due</td>
                            <td class="text-left">$50.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-left h4 mb-0">Total Due</td>
                            <td class="font-weight-bold text-left h4 mb-0">$450.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-left">
                                <button  class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-wallet"></i> Pay Invoice</button>
                                <button  class="btn btn-secondary" onClick="javascript:window.print();"><i class="si si-paper-plane"></i> Send Invoice</button>
                                <button  class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            </div>
        </div>
    </div>
</div>
<div class="app-content main-content" style="margin-right:0px;margin-top:0px;align-items: center;justify-content: center;">
    <div class="side-app">
        
        <!--Page header-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <h4 class="page-title">بازدید صورت حساب </h4>
            </div>
            <div class="page-leftheader mr-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('admin.filter-doctor')}}" class="btn btn-primary " data-toggle="modal" data-target="#addjobmodal"><i class="feather feather-plus fs-15 my-auto ml-2"></i>پرداخت به پزشک</a>
                        <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                        <button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                        <button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Page header-->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-11 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 ">
                            <a class="text-dark" href="#">
                            <h3 class="mb-2">صورت حساب دکتر{{$invoice->doctor->name}}</h3></a>
                            <div class="d-flex justify-content-center align-items-center">
                                @php
                                $vertaDate = verta($invoice->created_at);
                                @endphp
                                <ul class="mb-0 d-md-flex " style="">
                                    <li class="ml-5" style="position: absolute;left:10px;" data-placement="top" data-toggle="tooltip" title="تاریخ ایجاد صورت حساب">
                                        <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class="mb-4 font-weight-semibold">توضیحات</h5>
                        <ul class="list-style-disc mb-5">
                            <li>
                                @if (empty($invoice->description))
                                        توضیحات ندارد
                                    @else
                                    {{$invoice->description}}
                                @endif
                            </li>
                        </ul>
                        <h5 class="mb-3 mt-5 font-weight-semibold">مبلغ صورت حساب دکتر(تومان):{{number_format($invoice->amount)}}</h5>
                        <div class="card-body">
                        <h3 class="font-weight-semibold">اطلاعات پرداختی :  </h3>
                            <div class="table-responsive">
                                <ul class="list-group">
                                    @foreach ($invoice->payments as $item)
                                    <li class="list-group-item d-flex" style="justify-content: space-between">
                                @php
                                $vertaDate = verta($item->due_date);
                                @endphp
                                        <p>
                                            مبلغ پرداختی: {{number_format($item->amount)}}
                                        </p>
                                        <p>
                                            تاریخ پرداختی: {{$vertaDate->format('Y/n/j')}}
                                        </p>
                                        <p>
                                            وضعیت پرداخت:  @include('includes.status',["status" => $item->status])
                                        </p>
                                    </li>
                                    @endforeach
                                    <li class="list-group-item">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                        <h3 class="font-weight-semibold">اطلاعات جراحی :  </h3>
                            <div class="table-responsive">
                                <ul class="list-group">
                                    @foreach ($invoice->doctor->surgeries as $item)
                                    <li class="list-group-item d-flex" style="justify-content: space-between">
                                        <p>
                                            
                                            نام بیمار: {{$item->patient_name}}
                                        </p>
                                        <p>
                                            کد ملی بیمار: {{$item->patient_national_code}}
                                        </p>
                                    </li>
                                    @endforeach
                                    <li class="list-group-item">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-id">
                            <div class="row">
                                <div class="col">
                                    <a class="mb-0">شناسه صورت حساب : #{{ $invoice->id}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="icons">
                            <a class="btn btn-danger icons" href="{{route('admin.invoice.index')}}"> برگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection