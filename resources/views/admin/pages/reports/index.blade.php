@extends('admin.layouts.master')
@section('content')
 <!--Section-->
 <section>
    <div class="cover-image sptb ml-5 mr-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card mb-0 table-bordered">
                                <div class="card-header border-0">
                                    <h4 class="card-title">جراحی ها مربوط به دکتر{{$doctor->name}}</h4>
                                    <div class="card-options">
                                        <button  class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i>پرینت گزارش</button>
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
                                                    <th class="border-bottom-0 w-5 text-center">نام بیمار</th>
                                                    <th class="border-bottom-0 w-5 text-center">عمل ها</th>
                                                    <th class="border-bottom-0 w-5 text-center"> مبلغ عمل(تومان)</th>
                                                    <th class="border-bottom-0 w-5 text-center">تاریخ جراحی</th>
                                                    <th class="border-bottom-0 w-5 text-center">وضعیت صورت حساب</th>
                                                    <th class="border-bottom-0 w-5 text-center">توضیحات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($reportsDoctors as $reportsDoctor)
                                                @foreach ($reportsDoctor->surgeries as $item)
                                                <tr>
                                                    <td class="text-center"><span>{{$reportsDoctor->id}}</span></td>
                                                    <td class="text-center "><span>{{$item->patient_name}}</span></td>
                                                    <td class="text-center "><span>
                                                        @foreach($item->operations as $key => $item2)
                                                        {{$item2->name}}
                                                        @if($key < $item->operations->count() - 1),@endif
                                                        @endforeach
                                                    </span></td>
                                                    <td class="text-center "><span>
                                                        @foreach ($reportsDoctor->doctorRoles as $item6)
                                                        @endforeach
                                                            {{ number_format($item->getDoctorQuotaAmount($item6)) }}
                                                    </span></td>
                                                        @php
                                                        $vertaDate = verta($item->surgeried_at);
                                                        @endphp
                                                        <td class="text-center"><span>{{$vertaDate->format('Y/n/j')}}</span></td>
                                                        <td class="text-center "><span>
                                                            @foreach($reportsDoctor->invoices as $item4)
                                                            @include('includes.statusInvoice',["status" => $item4->status])
                                                            @endforeach
                                                        </span></td>
                                                        <td class="text-center "><span>
                                                            @foreach($reportsDoctor->invoices as $item5)
                                                                @if(empty($item5->discription)){{"ندارد"}}@else{{Str::limit($item5->discription,40, '...')}}@endif
                                                            @endforeach
                                                        </span></td>
                                                    </tr>
                                                        @foreach($reportsDoctor->payments as $item3)
                                                        @php
                                                            $sumPayments = 0;
                                                            $sumPayments += $item3->amount;
                                                        @endphp    
                                                        @endforeach
                                                    @endforeach
                                                    @empty
                                                    <tr>
                                                        <td>
                                                            <span class="text-danger">هیچ داده ای یافت نشد</span>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </div>
                                            </tbody>
                                        </table>
                                        <div class="d-flex" style="justify-content: space-between;">
                                            <p class=" mx-auto">مبلغ کل جراحی ها:{{$sumAmount}}</p>
                                            <p class=" mx-auto">مبلغ کل پرداختی ها:{{number_format($sumPayments)}}</p>
                                            {{-- <p class=" mx-auto">مبلغ باقی مانده:{{number_format($reportsDoctor->getRemainningAmount())}}</p> --}}
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
                Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
            </div>
        </div>
    </div>
</footer>
@endsection
