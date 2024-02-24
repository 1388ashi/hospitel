@extends('admin.layouts.master')
@section('content')
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
                                    @foreach ($invoice->paymentS as $item)
                                    <li class="list-group-item d-flex" style="justify-content: space-between">
                                @php
                                $vertaDate = verta($item->due_date);
                                @endphp
                                        <p>
                                            مبلغ پرداختی: {{$item->amount}}
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