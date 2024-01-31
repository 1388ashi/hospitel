@extends('admin.layouts.master')
@section('content')
<div class="page">
        <div class="app-content main-content" style="margin-right:0px;margin-top:1px;">
            <div class="side-app">
                @php
                $vertaDate = verta($announcements->published_at);
                @endphp
                <!-- Row -->
                <div class="page-header d-xl-flex d-block">
                    <div class="page-leftheader mr-md-auto ml-4">
                            <div class="btn-list">
                                <a href="{{route('announcements.index')}}" class="btn btn-primary text-left"><i class="feather feather-plus fs-15 my-auto ml-2"></i>ثبت اطلاعیه</a>
                            </div>
                    </div>
                </div>
                <div class="row item-right text-right" >
                    <div class="card" style="width: 95%;margin: 0 auto;top:-30px;">
                            <div class="card-body">
                                <div class="mb-5">
                                    <a class="text-dark" href="#">
                                        <h3 class="mb-2">{{$announcements->title}}</h3></a>
                                        <div class="col col-auto item-left text-left mb-4">
                                            نوشته شده توسط<a class="mb-0 font-weight-semibold text-orange mr-1 ml-1">{{$announcements->user->name}}</a> در تاریخ <a class="mb-0 font-weight-semibold text-orange">{{$announcements->created_at->diffForHumans()}}</a>
                                        </div>
                                    <div class="d-flex">
                                        <ul class="mb-0 d-md-flex">                      
                                            <li class="ml-5" data-placement="top" data-toggle="tooltip" title="تاریخ انتشار">
                                                <a class="icons" > <i class="feather feather-calendar"></i>{{$vertaDate->format('Y/n/j')}}</a>
                                            </li>
                                            <li class="ml-5" data-placement="top" data-toggle="tooltip" title="بازدید">
                                                <a class="icons" ><i class="si si-eye text-muted ml-1"></i>{{$announcements->views_count}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <img src="{{Storage::url($announcements->image)}}" style="width: 90px">
                                </div>
                                <br>
                                <h5 class="mb-4 font-weight-semibold">خلاصه توضیحات</h5>
                                <ul class="list-style-disc mb-5">
                                    <li>{{$announcements->summary}}</li>
                                </ul>
                                <h5 class="mb-4 font-weight-semibold">بدنه</h5>
                                <ul class="list-style-disc mb-5">
                                    <li>{!!$announcements->body!!}</li>
                                </ul>
                                <div class="card-body">
                                    <div class="list-id">
                                        <div class="row">
                                        <div class="col item-left text-left">
                                            <a class="mb-0"> شناسه اطلاعیه:#{{$announcements->id}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="icons">
                                    <a class="btn btn-danger"  href="{{route('announcements.index')}}">برگشت</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Row -->
                        </div>

        </div><!-- end app-content-->
    </div>

    <!--Footer-->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection