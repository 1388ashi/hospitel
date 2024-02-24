@extends('admin.layouts.master')
@section('content')
<div class="app-content main-content" style="margin-right:0px;margin-top:0px;align-items: center;justify-content: center;">
    <div class="side-app">
        <!--Page header-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <h4 class="page-title">بازدید جراحی</h4>
            </div>
            <div class="page-leftheader mr-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a href="{{route('admin.surgeries.create')}}" class="btn btn-primary " data-toggle="modal" data-target="#addjobmodal"><i class="feather feather-plus fs-15 my-auto ml-2"></i>اضافه کردن جراحی</a>
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
                            <h3 class="mb-2">{{$surgery->patient_name}}</h3></a>
                            <div class="d-flex justify-content-center align-items-center">
                                @php
                                $vertaDate = verta($surgery->surgeried_at);
                                $vertaDate2 = verta($surgery->released_at);
                                @endphp
                                <ul class="mb-0 d-md-flex " style="">
                                    <li class="ml-5" style="position: absolute;left:10px;" data-placement="top" data-toggle="tooltip" title="تاریخ عمل جراحی">
                                        <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class="mb-4 font-weight-semibold">توضیحات</h5>
                        <ul class="list-style-disc mb-5">
                            <li>
                                @if (empty($surgery->description))
                                        توضیحات ندارد
                                    @else
                                    {{$surgery->description}}
                                @endif
                            </li>
                        </ul>
                        <h5 class="mb-3 mt-5 font-weight-semibold">درباره جراحی</h5>
                        <div class="table-responsive">
                            <table class="table row table-borderless w-100 m-0 text-nowrap">
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><span class="font-weight-semibold">نام بیمار :</span>{{ $surgery->patient_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">دکتر ها:</span>
                                            @foreach($surgery->doctors as $key => $item)
                                            {{$item->name}} متخصص {{$item->specialtie->title}}
                                            @if($key < $surgery->doctors->count() - 1),@endif
                                            @endforeach</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><span class="font-weight-semibold">شماره سند :</span>{{$surgery->document_number}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">بیمه تکمیلی:</span>
                                            @if ($surgery->supp_insurance_id !== null)
                                            {{$surgery->suppInsurance->name}}
                                            @else
                                            -
                                            @endif 
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><span class="font-weight-semibold">عمل :</span>
                                            @foreach ($surgery->operations as $key => $item)
                                            {{$item->name}}
                                            @if($key < $surgery->operations->count() - 1),@endif
                                            @endforeach</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">کد ملی بیمار :</span>{{$surgery->patient_national_code}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">بیمه پایه:</span>
                                            @if ($surgery->basic_insurance_id !== null)
                                            {{$surgery->basicInsurance->name}}
                                            @else
                                            -
                                            @endif 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-id">
                            <div class="row">
                                <div class="col">
                                    <a class="mb-0">شناسه جراحی : #{{ $surgery->id}}</a>
                                </div>
                                <div class="col col-auto">
                                    تاریخ ترخیص :<a class="mb-0 font-weight-semibold"></a> {{$vertaDate2->format('Y/n/j')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="icons">
                            <a class="btn btn-danger icons" href="{{route('admin.surgeries.index')}}"> برگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>
                let arr = [1,2,3]
                arr.join
                ƒ join() { [native code] }
                arr.join(" - ")
            </script>
        @endsection