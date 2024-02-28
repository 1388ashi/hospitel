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
                                        <h4 class="card-title">اعلان ها</h4>
                                    </div>
                                    <x-alert-danger></x-alert-danger>
                                    <x-alert-success></x-alert-success>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter text-nowrap table-hover border table-striped" id="support-categorylist">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0 w-5">#شناسه</th>
                                                        <th class="border-bottom-0 w-5 text-center">عنوان</th>
                                                        <th class="border-bottom-0 w-5 text-center">بدنه</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ فرستاده شده</th>
                                                        <th class="border-bottom-0 w-5 text-center">تاریخ خوانده شده</th>
                                                        <th class="border-bottom-0 w-5 text-center">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($notifications as $notification)
                                                    <tr>
                                                        <td class="text-center"><span>{{$notification->id}}</span></td>
                                                        <td class="text-center "><span>{{$notification->title}}</span></td>
                                                        <td class="text-center "><span>{{Str::limit($notification->body,26,'...')}}</span></td>
                                                        <td class="text-center"><span>{{$notification->created_at->diffForHumans()}}</span></td>
                                                        <td class="text-center"><span>{{$notification->updated_at->diffForHumans()}}</span></td>
                                                        </span></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="{{route('admin.notify.show',[$notification->id])}}" class="action-btns1" style="background-color: lightblue"  data-target="#viewdoctors">
                                                                        <i class="feather feather-eye text-primary" data-toggle="tooltip" data-placement="top" title="بازدید"></i>
                                                                    </a>
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
                                        {{-- {{$invoices->onEachSide(1)->links("vendor.pagination.bootstrap-4")}} --}}
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
    @endsection
    